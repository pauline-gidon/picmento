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

class EditerPhotoTimeline extends Controller {


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

            $id_user = $_SESSION["auth"]["id"];
            $timeline = $managerT->oneTimelineById($id_timeline);
            if(!is_null($timeline)){

                $form = new FormEditeTimeline("post",$timeline);
                $build 		= $form->buildForm();
             
                $id_baby = $timeline->getBabyIdBaby();
                $managerB = new ManagerBaby($cx);
                $baby = $managerB->oneBabyById($id_baby);
                $datebaby = $baby->getDateNaissanceBaby();
                $datebaby = explode("-", $datebaby);
                $babyYear = $datebaby[0];
                $babyMonth = $datebaby[1];
            

                if(($form->isSubmit("timeline"))&&($form->isValid())){
                    $yearTimeline = $http->getDataPost("annee_photo_timeline");
                    $monthTimeline = $http->getDataPost("mois_photo_timeline");
                    $grossessY = $babyYear - 1;
                    $grossessM = $babyMonth - 1;

                    if($yearTimeline >= $grossessY && $monthTimeline>=$grossessY || $yearTimeline > $grossessY && $monthTimeline<=$grossessM){

                    $photoTimeline = $timeline->getNomPhotoTimeline();

                    $destination = "medias/timeline/";
                    $file 		= $http->getDataFiles("nom_photo_timeline");

                    $uploader = new Uploader($file,$destination);
                    $nom_file = $uploader->upload();
                    
                    if(!is_null($nom_file)){
                        //je supprime l'ancienne photo et je redimentionne la nouvelle
                            unlink($destination.$photoTimeline);
                            $uploader->imageSizing(700);
                            
                        }

                    

                    $timeline->setAnneePhotoTimeline($yearTimeline);
                    $timeline->setMoisPhotoTimeline($monthTimeline);

    
                    if($managerT->insertNewTimeline($timeline)){
                        $flash->setFlash("La photo a bien été ajoutée à la timeline !");
                    }else{
                        $flash->setFlash("Impossible d'ajouter la photo à la timeline. Veuillez réessayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span> ");
                    }
                    header("location: afficher-timeline-".$id_baby."");
                    exit();

                }else{
                    $flash->setFlash("Impossible d'ajouter la photo car la date renseigné est inférieure à la date estimé de grossesse !");

                }

            } //submit timeline
                
                    $cx->close();
                    return $build;
        }else{
            header("location: ".DOMAINE."errors/404.php");
            die();
        }
    }
	
}
