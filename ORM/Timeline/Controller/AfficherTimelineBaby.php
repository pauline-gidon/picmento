<?php
namespace ORM\Timeline\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;
use ORM\Baby\Model\ManagerBaby;
use ORM\Timeline\Model\ManagerTimeline;
use Vendors\Flash\Flash;



class AfficherTimelineBaby extends Controller {


        function getResult() {
            $this->setLayout("back");
            $this->setTitle("Timeline");
            $this->setView("ORM/Timeline/View/afficher-timeline.php");

            $http 	= new HTTPRequest();
            $id_baby 	= $http->getDataGet("id");
            $flash 			= new Flash();
            $cx = new Connexion();
            $managerB = new ManagerBaby($cx);
            $baby = $managerB->oneBabyById($id_baby);
            $general[] = $baby;

            // var_dump($baby);die();


            $managerT = new ManagerTimeline($cx);
            $timeline = $managerT->oneTimelineByIdBaby($id_baby);

            if(is_null($timeline)){
                $flash->setFlash("Cette timeline ne contient pas encore de photo, lancez-vous !");

            }else{
            $general [] = $timeline;
            }
            $cx->close();
            return $general;
        }
	
}
