<?php
namespace ORM\Article\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


use Vendors\Flash\Flash;

use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use Vendors\FormBuilded\FormEditeSouvenir;
use ORM\Commentaire\Model\ManagerCommentaire;

class SupprimerSouvenir extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Supprimer souvenir");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		$flash = new Flash();
        $http = new HTTPRequest();
		$id_article = $http->getDataGet("id");
		$id_baby = $http->getDataGet("idbaby");
		
		$cx			= new Connexion();
		$managerA	= new ManagerArticle($cx);
        $article = $managerA->oneArticleById($id_article);
        if(!is_null($article)){
            $medias = $managerA->articleCountMediasById($id_article);
            if(!is_null($medias)){
                foreach($medias as $media){
                    $id_media[]= $media->getIdMedias();
                    $nom_media = $media->getNomMedias();
                    $managerM = new ManagerMedias($cx);
                    $managerM->deleteMediasById($id_media);
                    $destination = "medias/souvenir/";
                    unlink($destination.$nom_media);
                }
            }
            $managerC = new ManagerCommentaire($cx);
            $commentaires = $managerC->fullCommentaireByIdArticle($id_article);
            if(!is_null($commentaires)){
                foreach($commentaires as $commentaire){
                    $id_coms []= $commentaire->getIdCommentaire();
                    foreach($id_coms as $id_com){
                        $managerC->deleteCommentaireById($id_com);
                    }
                }
            }
            if($managerA->deleteArticleHasBaby($id_article,$id_baby)){
                if($managerA->deleteArticleByIds($id_article)){
                    $flash->setFlash("Le souvenir a bien été supprimer");
                }   
            }
        }
        $cx->close();
        header("location: afficher-souvenirs-".$id_baby."");
        exit();
    }
}


		


