<?php
namespace ORM\Medias\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use ORM\User\Model\ManagerUser;
// use ORM\Medias\Model\ManagerMedias;
// use ORM\Article\Entity\Article;
// use ORM\Medias\Entity\Medias;
// use ORM\Baby\Model\ManagerBaby;

use Vendors\FormBuilded\FormPhoto;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;

class EditerPhoto extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier une photo");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id_photo = $http->getDataGet("id");
        $id_baby = $http->getDataGet("idbaby");
        // var_dump($id_photo);
        // var_dump($id_baby); die();
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        if(($managerU->verifUserMedias($id_photo))&&($managerU->verifUserBaby($id_baby))){


            $managerM = new ManagerMedias($cx);
            $photo = $managerM->oneMediasById($id_photo);
    
            // var_dump($article);die;
            
            if(!is_null($photo)){
                $form 		= new FormPhoto();
                $build 		= $form->buildForm();
            }
            
            $flash = new Flash();
            if(($form->isSubmit("addPhoto"))&&($form->isValid())){
                //je recupère le nom de la photo qui va etre remplacer
                $nom_photo = $photo->getNomMedias();
                //suppression du précédant medias
                $destination = "medias/souvenir/";
                unlink($destination.$nom_photo);
                
                //upload de fichier
                $file 		= $http->getDataFiles("photo");
                $uploader = new Uploader($file,$destination);
                $nom_file = $uploader->upload();

                if(!is_null($nom_file)){
                    //Avec redimensionnement si nécessaire
                    $photo->setNomMedias($nom_file);
                    $uploader->imageSizing(400);

                    if($managerM->updateMedias($photo)){

                        $flash->setFlash("La photo de a bien été modifée <a href=\"afficher-souvenirs-".$id_baby."\" title=\"Retour aux souvenirs\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");



                    }
                }
    
                
    
    
    
                    
            }
        
    
            return $build;

        }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
        }
    }
}


		


