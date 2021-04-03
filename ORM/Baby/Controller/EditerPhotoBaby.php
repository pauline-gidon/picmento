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
        if($managerU->verifUser($id)){

            
            $manager	= new ManagerBaby($cx);
            $baby 		= $manager->oneBabyById($id);
            if (!is_null($baby)){
                $nom_baby = $baby->getNomBaby();
                
            
                $form 		= new FormPhotoBaby("post",$baby);
                $build 		= $form->buildForm();
                
                if(($form->isSubmit("addbaby"))&&($form->isValid())){
                    $flash = new Flash();
                    
                    //upload de fichier
                    $file 		= $http->getDataFiles("photo_baby");
                    $destination = "medias/photo-baby/";
                    $uploader = new Uploader($file,$destination);
                    $nom_file = $uploader->upload();
                    
                    if(!is_null($nom_file)){
                        //Avec redimensionnement si nécessaire
                        $uploader->imageSizing(500);
                    }
                    
                    if((isset($nom_file))&&(!is_null($nom_file))) {
                        $baby->setPhotoBaby($nom_file);
                    }
                
        
                        if($manager->updatephotoBaby($baby)){
                            
                            $flash->setFlash("La photo de ".$nom_baby." a bien été modifée");
                        }else{
                            $flash->setFlash("Impossible de modifier la photo de ".$nom_baby." réesayez ou contactez l'équipe picmento");
                        }
                        header("Location: afficher-tribu");
        
                        
                }
        
    
            }else{
                header("location: afficher-tribu");
            }
        
        }else{
            header("location: ".DOMAINE."errors/404.php");
            die();
        }

		return $build;

		}
	}


		


