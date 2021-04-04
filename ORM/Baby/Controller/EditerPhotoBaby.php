<?php
namespace ORM\Baby\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


// use ORM\Tribu\Model\ManagerTribu;
// use ORM\Baby\Entity\Baby;
use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use Vendors\FormBuilded\FormPhotoBaby;

use Vendors\Flash\Flash;
use Vendors\File\Uploader;


class EditerPhotoBaby extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier la photo");
		$this->setView("ORM/Baby/View/form-baby-tribu.php");
		
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        $http = new HTTPRequest();
        $id = $http->getDataGet("id");
        if($managerU->verifUserBaby($id)){

            
            $manager	= new ManagerBaby($cx);
            $baby 		= $manager->oneBabyById($id);
            if (!is_null($baby)){
                $nom_baby = $baby->getNomBaby();
                $photo_baby = $baby->getPhotoBaby();
                
            
                $form 		= new FormPhotoBaby("post",$baby);
                $build 		= $form->buildForm();
                
                $flash = new Flash();
                if(($form->isSubmit("addbaby"))&&($form->isValid())){
                    //suppression de l'ancienne image
                            $destination = "medias/photo-baby/";
                            unlink($destination.$photo_baby);
                    //upload de fichier
                    $file 		= $http->getDataFiles("photo_baby");
                    $uploader = new Uploader($file,$destination);
                    $nom_file = $uploader->upload();
                    
                    if(!is_null($nom_file)){
                        //Avec redimensionnement si nécessaire
                        $baby->setPhotoBaby($nom_file);
                        
                        $uploader->imageSizing(300);

                        if($manager->updatephotoBaby($baby)){
                            
                            $flash->setFlash("La photo de ".$nom_baby." a bien été modifée <a href=\"afficher-tribu\" title=\"Retour Tribu\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");
                        }else{
                            $flash->setFlash("Impossible de modifier la photo de ".$nom_baby." réesayez ou contactez l'équipe <span class=\"flash-logo\">Picmento</span> <a href=\"afficher-tribu\" title=\"Retour Tribu\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");
                        }
                    }else{
                        $flash->setFlash("Problème lors de l'upload du fichier");
                    }
        
                        
                }
            }else{
                header("location: afficher-tribu");
            }
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    $cx->close();
    return $build;

    }
}


		


