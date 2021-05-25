<?php
namespace ORM\Commentaire\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormCommentaire;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use ORM\Commentaire\Entity\Commentaire;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Tribu\Model\ManagerTribu;

class SupprimerCommentaire extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Supprimer un commentaire");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id_com = $http->getDataGet("id");
		$id_baby = $http->getDataGet("idbaby");

		$cx			= new Connexion();
        //pour la suppression du commentaire je verifie si c'est la persione qui a ecri le commentaire ou si c'est la personne propriétaire de la tribu
        //pour sa je vais recupéré le commentaire
        $managerC = new ManagerCommentaire($cx);
        $com = $managerC->oneCommentaireById($id_com);
        $flash = new Flash();
        // je recupère l'article pour rediriger l'ancre au bon article après suppression
        $article = $managerC->oneArticleByIdCom($id_com);
        $id_article= $article->getIdArticle();
        
        if(!is_null($com)){
            $managerT = new ManagerTribu($cx);
            //il faut que je recupère la tribu pour verifier si la personne qui veut supprimer ce commentaire a les droit
            $tribu = $managerT->oneTribuByIdCom($com->getIdCommentaire());
            //donc je recupère 3 ID  pour faire la condition de suppression
            //1-je recupère l'id_user du commentaire
            //2- les id parent tribu
            if($com->getUserIdUser() == $_SESSION["auth"]["id"] || $tribu->getUserIdParent1() == $_SESSION["auth"]["id"] || $tribu->getUserIdParent2() == $_SESSION["auth"]["id"]){

                $managerC->deleteCommentaireById($id_com);
                $flash->setFlash("Le commentaire a bien été supprimé !");
               
            }else{
                $flash->setFlash("Vous n'avez pas les droits pour supprimer ce commentaire !");
            }
            
            $cx->close();
            header("location: afficher-souvenirs-".$id_baby."#ancre-".$id_article."");
            exit();

        }
    }
}

    
                
    


		


