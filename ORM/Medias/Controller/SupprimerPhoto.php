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
        // var_dump($id_photo);
        // var_dump($id_baby); die();
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        if(($managerU->verifUserMedias($id_photo))&&($managerU->verifUserBaby($id_baby))){
            $flash = new Flash();


            $managerM = new ManagerMedias($cx);
            $photo = $managerM->oneMediasById($id_photo);
    
            
            if(!is_null($photo)){
                
                if($managerM->deleteMediasById($photo->getIdMedias())){
                    $destination = "medias/souvenir/";
                    unlink($destination.$photo->getNomMedias());
    
                    $flash->setFlash("La photo a bien été supprimée <a href=\"afficher-souvenirs-".$id_baby."\" title=\"Continuer\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Continuer</a>");
                }
            }
            
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}


		


