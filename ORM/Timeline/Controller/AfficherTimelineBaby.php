<?php
namespace ORM\Timeline\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use ORM\Timeline\Model\ManagerTimeline;
use OCFram\Navbaby;




class AfficherTimelineBaby extends Controller {
use Navbaby;

        function getResult() {
            $this->setLayout("back");
            $this->setTitle("Timeline");
            $this->setView("ORM/Timeline/View/afficher-timeline.php");

            $http 	= new HTTPRequest();
            $id_baby 	= $http->getDataGet("id");
            $flash 			= new Flash();
            $cx = new Connexion();
            $manager = new ManagerBaby($cx);
            $id_user = $_SESSION["auth"]["id"];
            $babys=  $manager->allBabyHasUser($id_user);
            $this->navConstruction($babys);

            $managerU = new ManagerUser($cx);
            $id_user = $_SESSION["auth"]["id"];

            if($managerU->verifUserBaby($id_baby, $id_user)){
                
                $managerB = new ManagerBaby($cx);
                $baby = $managerB->oneBabyById($id_baby);
                if(!is_null($baby)){

                    $general[] = $baby;
        
        
        
                    $managerT = new ManagerTimeline($cx);
                    $timeline = $managerT->oneTimelineByIdBaby($id_baby);
        
                    if(is_null($timeline)){
                        $flash->setFlash("Cette timeline ne contient pas encore de photo, lancez-vous !");
        
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
