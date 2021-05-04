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

class AjouterCommentaire extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Ajouter un commentaire");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id_article = $http->getDataGet("id");
        $id_baby = $http->getDataGet("idbaby");

		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        //pour ajouter un commentaire je verifie les relation user
        //pour sa je vais recupéré la tribu lié a l'article du bébé
        $managerT = new ManagerTribu($cx);
        $tribu = $managerT->oneTribuByIdArticle($id_article,$id_baby);
        if(!is_null($tribu)){
            //je recupère parent 1 et parent 2 et je les compare a l'auth qui est connecter
            $id_parent1 = $tribu->getUserIdParent1();
            $id_parent2 = $tribu->getUserIdParent2();
            $user = $managerU->verifUserAmisUserConnecter($id_parent1, $id_parent2);
            if(!is_null($user) || $tribu->getUserIdParent1() == $_SESSION["auth"]["id"] || $tribu->getUserIdParent2() == $_SESSION["auth"]["id"]){
                $managerA = new ManagerArticle($cx);
                $souvenir = $managerA->oneArticleById($id_article);
        
                
                if(!is_null($souvenir)){
                    $id_article = $souvenir->getIdArticle();
                    $form 		= new FormCommentaire();
                    $build 		= $form->buildForm();
                    
                    $flash = new Flash();
                    if(($form->isSubmit("go"))&&($form->isValid())){
                        
                        $new_commentaire = new Commentaire ([
                            "description_commentaire" 	=> $http->getDataPost("description_commentaire"),
                            "user_id_user" => $_SESSION["auth"]["id"]
                            
                            ]);
                            
                        $managerC = new ManagerCommentaire($cx);
                        if($managerC->insertNewCommentaire($new_commentaire,$id_article) > 0){
                            $flash->setFlash("Votre commentaire a bien été ajouter");
                        }else{
                            $flash->setFlash("Impossible d'ajouter votre commentaire");
                        }
                        header("location: afficher-souvenirs-".$id_baby."");
                        exit();
    
    
        
        
        
                    }
                }
                $cx->close();
                return $build;
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

    
                
    


		


