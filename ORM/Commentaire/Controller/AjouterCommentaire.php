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
        if($managerU->verifUserArticle($id_article)){


            $managerM = new ManagerArticle($cx);
            $souvenir = $managerM->oneArticleById($id_article);
    
            // var_dump($article);die;
            
            if(!is_null($souvenir)){
                // var_dump($souvenir);die();
                $form 		= new FormCommentaire();
                $build 		= $form->buildForm();

                $flash = new Flash();
                if(($form->isSubmit("go"))&&($form->isValid())){
                    
                    $new_commentaire = new Commentaire ([
                        "description_commentaire" 	=> $http->getDataPost("description_commentaire"),
                        "user_id_user" => $_SESSION["auth"]["id"],
                        "article_id_article" => $id_article
                    ]);

                    $managerC = new ManagerCommentaire($cx);
                    if($managerC->insertNewCommentaire($new_commentaire)){
                        $flash->setFlash("Votre commentaire a bien été ajouter");
                    }else{
                        $flash->setFlash("Impossible d'ajouter votre commentaire");
                    }
                    header("location: afficher-souvenirs-".$id_baby."");


    
    
    
                }
            }
            return $build;
            
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}
    
                
    


		


