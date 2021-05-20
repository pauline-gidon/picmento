<?php
namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use ORM\Article\Model\ManagerArticle;

use Vendors\Flash\Flash;
use Vendors\FormBuilded\FormEditeSouvenir;

class VisibleSouvenir extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id_article = $http->getDataGet("id");
		$id_baby = $http->getDataGet("idbaby");
		$cx			= new Connexion();
		$manager	= new ManagerArticle($cx);
        $article = $manager->oneArticleById($id_article);
        
		$flash = new Flash();
        if(!is_null($article)){
            if($article->getActifArticle() == 1){
                $article->setActifArticle(0);
            }else{
                $article->setActifArticle(1);
            }
            $manager->updateArticle($article);
            $cx->close();

            $actif = $article->getActifArticle();
            $titre = $article->getTitreArticle();
            if($actif == 0){
                $flash->setFlash("Votre souvenir \"".$titre."\" est devenue privé !");
            }else{
                $flash->setFlash("Votre souvenir \"".$titre."\" est devenue public !");
            }
            header("location: afficher-souvenirs-".$id_baby."#ancre-".$article->getIdArticle()."");
            exit();
        }
	}
}


		


