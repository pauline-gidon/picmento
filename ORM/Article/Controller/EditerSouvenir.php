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
        if($managerU->verifUserArticle($id)){
            $manager	= new ManagerArticle($cx);
            $article = $manager->oneArticleById($id);

            if(!is_null($article)){
                $form 		= new FormEditeSouvenir("post",$article);
                $build 		= $form->buildForm();
                
                if(($form->isSubmit("souvenir"))&&($form->isValid())){
                    $flash = new Flash();
                    
                    $article->setTitreArticle(ucfirst($http->getDataPost("titre_article")));
                    $article->setDescriptionArticle(ucfirst($http->getDataPost("description_article")));
                    $article->setDateArticle($http->getDataPost("date_article"));
                    
    
                    
                    if($manager->updateArticle($article)){
                            
                        $flash->setFlash("L'article a bien été modifié !");
                        header("location: afficher-souvenirs-".$_SESSION["idBaby"]."");
                        exit();
                    }else{
                        $flash->setFlash("Vous n'avez pas fait de modification !");
                        header("location: afficher-souvenirs-".$_SESSION["idBaby"]."");
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


		


