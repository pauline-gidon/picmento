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
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        if($managerU->verifUserMedias($id_photo)){


            $managerM = new ManagerMedias($cx);
            $photo = $managerM->oneMediasById($id_photo);
    
            // var_dump($article);die;
            
            if(!is_null($photo)){
                $form 		= new FormPhoto();
                $build 		= $form->buildForm();
            }
            
            $flash = new Flash();
            if(($form->isSubmit("addPhoto"))&&($form->isValid())){

                //upload de fichier
                $file 		= $http->getDataFiles("photo");
                $destination = "medias/souvenir/";
                $uploader = new Uploader($file,$destination);
                $nom_file = $uploader->upload();
                
                if(!is_null($nom_file)){
                    //Avec redimensionnement si nécessaire
                    $photo->setNomMedias($nom_file);
                    $uploader->imageSizing(400);


                }
    
                
                if($manager->updateArticle($article)){
                        
                    $flash->setFlash("L'article a bien été modifié");
                }else{
                    $flash->setFlash("Impossible de modifier l'article, veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
                }
                header("Location: afficher-souvenirs-".$id_baby."");
    
    
    
                    
            }
        
    
            return $build;

        }else{

        }
    }
}


		


