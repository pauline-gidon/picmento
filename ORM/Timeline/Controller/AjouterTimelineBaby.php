<?php
namespace ORM\Timeline\Controller;

use DateTime;
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

class AjouterTimelineBaby extends Controller {


        function getResult() {
            $this->setLayout("back");
            $this->setTitle("Conception de la timeline");
            $this->setView("ORM/Article/View/afficher-form-simple.php");

            $http 	= new HTTPRequest();
            $id_baby 	= $http->getDataGet("id");
            $cx = new Connexion();
            $managerU = new ManagerUser($cx);
            $id_user = $_SESSION["auth"]["id"];

            if($managerU->verifUserBaby($id_baby, $id_user)){

                $flash 			= new Flash();
    
                $form = new FormTimeline();
                $build 		= $form->buildForm();
                $managerB = new ManagerBaby($cx);
                $baby = $managerB->oneBabyById($id_baby);
                $datebaby = $baby->getDateNaissanceBaby();
                $datebaby = explode("-", $datebaby);
                $babyYear = $datebaby[0];
                $babyMonth = $datebaby[1];
            

                if(($form->isSubmit("timeline"))&&($form->isValid())){
                    $dateTimeline = $http->getDataPost("date_timeline");
                    list($yearTimeline,$monthTimeline,$day) = explode("-",substr($dateTimeline,0,10));
      
                    //j'estime une date de grossess (1 an avan la naissance de l'enfant)
                    $yearGrossess = $babyYear - 1;
                    $monthGrossess = $babyMonth ;

                        if(
                            $yearTimeline == $yearGrossess && $monthTimeline>=$monthGrossess 
                            || 
                            $yearTimeline > $yearGrossess && $monthTimeline <= $monthGrossess 
                            || 
                            $yearTimeline > $yearGrossess && $monthTimeline >= $monthGrossess
                            
                            ){

                        $file 		= $http->getDataFiles("nom_photo_timeline");
                        $destination = "medias/timeline/";
                        $uploader = new Uploader($file,$destination);
                        $nom_file = $uploader->upload();
                        
                        if(!is_null($nom_file)){
                            //Avec redimensionnement si nécessaire
                            $uploader->imageSizing(700);
                            
                        }
                        $timeline = new Timeline([
                            "nom_photo_timeline"    => $nom_file,
                            "annee_photo_timeline"  => $yearTimeline,
                            "mois_photo_timeline"   => $monthTimeline,
                            "baby_id_baby"          => $id_baby
                        ]);
                        $managerT = new ManagerTimeline($cx);
    
        
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
            }else{
                header("location: ".DOMAINE."errors/404.php");
                die();
            }

            $cx->close();
            return $build;
        }
	
}
