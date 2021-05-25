<?php
namespace ORM\Commentaire\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use ORM\Article\Entity\Article;
use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormCommentaire;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use ORM\Commentaire\Entity\Commentaire;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Tribu\Model\ManagerTribu;

class EditerCommentaire extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier un commentaire");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id_com = $http->getDataGet("id");
		$id_baby = $http->getDataGet("idbaby");

		$cx			= new Connexion();
        //pour la Modification du commentaire je verifie si c'est la personne qui a écrit le commentaire 
        //pour sa je vais recupéré le commentaire
        $managerC = new ManagerCommentaire($cx);
        $com = $managerC->oneCommentaireById($id_com);
        $flash = new Flash();

        if(!is_null($com)){
                    // il faut que je maitrise la modification de ce commentaire aussi lié a l'article du baby
        $id_article = $com->getArticleIdArticle();
      
        $managerArticle = new ManagerArticle($cx);
        //je recupère un tableau de baby
        $result = $managerArticle->oneArticleByIds($id_article, $id_baby);
        if($result === TRUE){
            $managerT = new ManagerTribu($cx);
            //je recupère l'id_user du commentaire et verifier si c'est bien l'auth connecter
            if($com->getUserIdUser() == $_SESSION["auth"]["id"]){
                $form 		= new FormCommentaire("post",$com);
                $build 		= $form->buildForm();
                // je recupère l'article pour rediriger l'ancre au bon article après modification
                $article = $managerC->oneArticleByIdCom($id_com);
                $id_article= $article->getIdArticle();
                // var_dump($id_baby); die();
                
                if(($form->isSubmit("go"))&&($form->isValid())){
                        
                    
                    $com->setDescriptionCommentaire($http->getDataPost("description_commentaire"));
                    if($managerC->updateCommentaire($com)){

                        $flash->setFlash("Le commentaire a bien été modifié !");
                        header("location: afficher-souvenirs-".$id_baby."#ancre-".$id_article."");
                        exit();

                    }else{
                        
                        $flash->setFlash("Vous n'avez pas fait de modification !");
                        header("location: afficher-souvenirs-".$id_baby."#ancre-".$id_article."");
                        exit();
                        
                    }
                
                    // header("location: afficher-souvenirs-".$id_baby."");
                    
                }
                $cx->close();
                return $build;
            }else{
                $flash->setFlash("Vous n'avez pas les droits pour modifier ce commentaire !");
                header("location: afficher-souvenirs-".$id_baby."#ancre-".$id_article."");
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
                
    


		


