<?php
namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use ORM\Article\Model\ManagerArticle;
use ORM\User\Model\ManagerUser;
use Vendors\Flash\Flash;
use Vendors\FormBuilded\FormEditeSouvenir;

class EditerSouvenir extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier un souvenir");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id = $http->getDataGet("id");
		
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        // je verifie si c'est bien l'un des deux parent de connecter
        if($managerU->verifUserArticle($id)){
            $manager	= new ManagerArticle($cx);
            $article = $manager->oneArticleById($id);
            $id_article = $article->getIdArticle();

            if(!is_null($article)){
                $form 		= new FormEditeSouvenir("post",$article);
                $build 		= $form->buildForm();
                
                if(($form->isSubmit("souvenir"))&&($form->isValid())){
                    $flash = new Flash();
                    
                    $article->setTitreArticle(ucfirst($http->getDataPost("titre_article")));
                    $article->setDescriptionArticle(ucfirst($http->getDataPost("description_article",1)));
                    $article->setDateArticle($http->getDataPost("date_article"));
                    
    
                    
                    if($manager->updateArticle($article)){
                            
                        $flash->setFlash("L'article a bien été modifié !");
                        header("location: afficher-souvenirs-".$_SESSION["idBaby"]."#ancre-".$id_article."");
                        exit();
                    }else{
                        $flash->setFlash("Vous n'avez pas fait de modification !");
                        header("location: afficher-souvenirs-".$_SESSION["idBaby"]."#ancre-".$id_article."");
                        exit();
                    }
                }    
                    
            }
            $cx->close();
            return $build;
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }

		}
	}


		


