<?php
namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use ORM\Article\Model\ManagerArticle;
// use ORM\Medias\Model\ManagerMedias;
// use ORM\Article\Entity\Article;
// use ORM\Medias\Entity\Medias;
// use ORM\Baby\Model\ManagerBaby;

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
		$manager	= new ManagerArticle($cx);
        $article = $manager->oneArticleById($id);

        // var_dump($article);die;
		
		
		$form 		= new FormEditeSouvenir("post",$article);
		$build 		= $form->buildForm();
		
		if(($form->isSubmit("souvenir"))&&($form->isValid())){
            $flash = new Flash();
			
            $article->setTitreArticle($http->getDataPost("titre_article"));
            $article->setDescriptionArticle($http->getDataPost("description_article"));
            $article->setDateArticle($http->getDataPost("date_article"));
            $article->setActifArticle($http->getDataPost("actif_article"));

    
            $baby = $manager->babyWithArticleById($id);
            $id_baby = $baby->getIdBaby();

            
            if($manager->updateArticle($article)){
					
                $flash->setFlash("L'article a bien été modifié");
            }else{
                $flash->setFlash("Impossible de modifier l'article, veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
            }
            header("Location: afficher-souvenirs-".$id_baby."");



				
		}
	

		return $build;

		}
	}


		


