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
        $cx			= new Connexion();
        $flash 			= new Flash();
        $managerU = new ManagerUser($cx);
        //une variable de session a été crée à, l'affichage des tribu de mon amis avec id ami $_SESSION["ami"]["id"]
        //je verifie si la personne connecter et le profil visité son bien amis
        //je recupère la tribu de du baby pour recupérer les parents 

        $id_user = $_SESSION["ami"]["id"];
        $manager1	= new ManagerBaby($cx);
        $babys=  $manager1->allBabyHasUserAmi($id_user);

        $this->navConstruction($babys);
        if($managerU->verifUserAmis($id_user)){
            
            //je verifie si ce baby appartien bien a id du parent
            if($managerU->verifUserBaby($id_baby, $id_user)){
                $managerB = new ManagerBaby($cx);
                $baby = $managerB->oneBabyById($id_baby);
                if(!is_null($baby)){
                
                    $general[] = $baby;
                
                    $managerTime = new ManagerTimeline($cx);
                    $timeline = $managerTime->oneTimelineByIdBaby($id_baby);
                
                    if(is_null($timeline)){
                        $flash->setFlash("Cette enfant n'a pas encore de timeline à vous montrer !");
                
                    }else{
                    $general [] = $timeline;
                    }
                }
                $cx->close();
                return $general;        
            }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }

        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}



