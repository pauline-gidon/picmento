<?php
namespace ORM\Timeline\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use ORM\Baby\Model\ManagerBaby;
use ORM\Timeline\Entity\Timeline;
use Vendors\FormBuilded\FormTimeline;
use ORM\Timeline\Model\ManagerTimeline;
use ORM\Tribu\Model\ManagerTribu;

class AjouterTimelineBaby extends Controller {


        function getResult() {
            $this->setLayout("back");
            $this->setTitle("Conception de la timeline");
            $this->setView("ORM/Article/View/afficher-form-simple.php");

            $http 	= new HTTPRequest();
            $id_baby 	= $http->getDataGet("id");
            $flash 			= new Flash();
            $cx = new Connexion();

            $form = new FormTimeline();
            $build 		= $form->buildForm();

            if(($form->isSubmit("timeline"))&&($form->isValid())){
                $file 		= $http->getDataFiles("nom_photo_timeline");
                $destination = "medias/timeline/";
                $uploader = new Uploader($file,$destination);
                $nom_file = $uploader->upload();
                
                if(!is_null($nom_file)){
                    //Avec redimensionnement si nécessaire
                    $uploader->imageSizing(400);
                    
                }
                $timeline = new Timeline([
                    "nom_photo_timeline"    => $nom_file,
                    "annee_photo_timeline"  => $http->getDataPost("annee_photo_timeline"),
                    "mois_photo_timeline"   => $http->getDataPost("mois_photo_timeline"),
                    "baby_id_baby"          => $id_baby
                ]);
                $managerT = new ManagerTimeline($cx);

                if($managerT->insertNewTimeline($timeline)){
                    $flash->setFlash("La photo a bien été ajoutée à la timeline");
                }else{
                    $flash->setFlash("Impossible d'ajouter la photo à la timeline, réesayez ou contactez l'équipe picmento");
                }
                header("location: afficher-timeline-".$id_baby."");

            }

            return $build;
        }
	
}
