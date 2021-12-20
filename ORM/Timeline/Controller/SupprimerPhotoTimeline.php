<?php
namespace ORM\Timeline\Controller;

use DateTime;
use Vendors\Cryptor;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use ORM\Timeline\Entity\Timeline;
use ORM\Tribu\Model\ManagerTribu;
use Vendors\FormBuilded\FormTimeline;
use ORM\Timeline\Model\ManagerTimeline;
use Vendors\FormBuilded\FormEditeTimeline;

class SupprimerPhotoTimeline extends Controller {


        function getResult() {
            $this->setLayout("back");
            $this->setTitle("Modification de la timeline");
            $this->setView("ORM/Article/View/afficher-form-simple.php");
            
            $flash 			= new Flash();
            $http 	= new HTTPRequest();
            $id_timeline_chiffrer 	= $http->getDataGet("id");
            $cryptor = new Cryptor();
            $id_timeline = $cryptor->decrypt($id_timeline_chiffrer);
      
            $cx = new Connexion();
            $managerT = new ManagerTimeline($cx);

            $timeline = $managerT->oneTimelineById($id_timeline);
            if(!is_null($timeline)){

                $id_baby = $timeline->getBabyIdBaby();

                if($managerT->deleteTimelineById($id_timeline)){
                    $destination = "medias/timeline/";
                    unlink($destination.$timeline->getNomPhotoTimeline());
    
                    $flash->setFlash("La photo a bien été supprimée !");
                    header("location: afficher-timeline-".$id_baby);
                    exit();
                }

                
                    $cx->close();
                 
        }else{
            header("location: ".DOMAINE."errors/404.php");
            die();
        }
    }
	
}
