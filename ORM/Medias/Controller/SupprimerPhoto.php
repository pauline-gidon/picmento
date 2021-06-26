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

class SupprimerPhoto extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier une photo");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id_photo = $http->getDataGet("id");
        $id_baby = $http->getDataGet("idbaby");
        $id_article = $http->getDataGet("idsouvenir");

		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        $id_user = $_SESSION["auth"]["id"];
     
        $photo = $managerU->verifUserMedias($id_photo);
        $baby = $managerU->verifUserBaby($id_baby, $id_user);
             
       
        if(($managerU->verifUserMedias($id_photo))&&($managerU->verifUserBaby($id_baby, $id_user))){
            var_dump('gg');
            $flash = new Flash();


            $managerM = new ManagerMedias($cx);
            //je verifie la relation de l'article a son medias
            if($managerM->verifRelationMediaArticle($id_photo, $id_article)){
                //je verifie la relation de l'article a son baby
                if($managerM->verifRelationBabyArticle($id_baby, $id_article)){
                    $photo = $managerM->oneMediasById($id_photo);
    
            
                    if(!is_null($photo)){
                        
                        if($managerM->deleteMediasById($photo->getIdMedias())){
                            $destination = "medias/souvenir/";
                            unlink($destination.$photo->getNomMedias());
            
                            $flash->setFlash("La photo a bien été supprimée !");
                            header("location: afficher-souvenirs-".$id_baby."#ancre-".$id_article."");
                            exit();
                        }
                    }
                }else{
                    header("location: ".DOMAINE."errors/404.php");
                    exit();
                }
            }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}


		


