<?php
namespace ORM\Timeline\Controller;
use OCFram\Navbaby;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use ORM\Tribu\Model\ManagerTribu;
use ORM\Timeline\Model\ManagerTimeline;




class AmisAfficherTimelineBaby extends Controller {
use Navbaby;

        function getResult() {
            $this->setLayout("back");
            $this->setTitle("Timeline");
            $this->setView("ORM/Timeline/View/ami-afficher-timeline.php");

            $http 	= new HTTPRequest();
            $id_baby 	= $http->getDataGet("id");
            $flash 			= new Flash();
            $cx = new Connexion();
            //je recupère la tribu de du baby pour recupérer les parents 
            $managerT = new ManagerTribu($cx);
            $tribu = $managerT->oneTribuByIdBaby($id_baby);
            $id_parent1 = $tribu->getUserIdParent1();
            $id_parent2 = $tribu->getUserIdParent2();
            $managerU = new ManagerUser($cx);
            // et verifier si la personne est amis avec l'un des deux parent
            $user = $managerU->verifUserAmisUserConnecter($id_parent1, $id_parent2);
            if(!is_null($user)){
                
                $managerB = new ManagerBaby($cx);
                $baby = $managerB->oneBabyById($id_baby);
                if(!is_null($baby)){

                    $general[] = $baby;
        
        
        
                    $managerTime = new ManagerTimeline($cx);
                    $timeline = $managerTime->oneTimelineByIdBaby($id_baby);
        
                    if(is_null($timeline)){
                        $flash->setFlash("Cette enfant n'as pas encore de timeline a vous montrez !");
        
                    }else{
                    $general [] = $timeline;
                    }
                }
                $cx->close();
                return $general;
            }else{
                header("location: ".DOMAINE."errors/404.php");
                die();
            }
    
        }
	
}
