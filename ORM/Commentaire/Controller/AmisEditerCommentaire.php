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

class AmisEditerCommentaire extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier un commentaire");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id_com = $http->getDataGet("id");
		$id_baby = $http->getDataGet("idbaby");

        $flash = new Flash();
		$cx			= new Connexion();
        //pour la Modification du commentaire je verifie si c'est la personne qui a ecri le commentaire 
        //pour sa je vais recupéré le commentaire
        $managerC = new ManagerCommentaire($cx);
        $com = $managerC->oneCommentaireById($id_com);
        // je recupère l'article pour rediriger l'ancre au bon article après modification
        $article = $managerC->oneArticleByIdCom($id_com);
        $id_article= $article->getIdArticle();
        if(!is_null($com)){
            // $managerT = new ManagerTribu($cx);
            //je recupère l'id_user du commentaire et verifier si c'est bien l'auth connecter
            if($com->getUserIdUser() == $_SESSION["auth"]["id"]){
                $form 		= new FormCommentaire("post",$com);
                $build 		= $form->buildForm();
                if(($form->isSubmit("go"))&&($form->isValid())){
                  
                        $com->setDescriptionCommentaire($http->getDataPost("description_commentaire"));
                        $up_com = $managerC->updateCommentaire($com);
                    if($managerC->updateCommentaire($com)){

                        $flash->setFlash("Le commentaire a vien été modifié !");

                    }else{
                        
                        $flash->setFlash("Vous n'avez pas fait de modification !");
                        
                    }
                    header("location: ami-afficher-souvenirs-".$id_baby."#ancre-".$id_article."");
                    exit();
                
                    
                }
                $cx->close();
                return $build;
            }else{
                $flash->setFlash("Vous n'avez pas les droits pour modifier ce commentaire !");
                header("location: ami-afficher-souvenirs-".$id_baby."#ancre-".$id_article."");
                exit();
            }
            
        }
    }
}
                
    


		


