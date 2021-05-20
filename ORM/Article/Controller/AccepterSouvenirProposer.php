<?php
namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use ORM\Article\Model\ManagerArticle;
use ORM\User\Model\ManagerUser;
use Vendors\Flash\Flash;
use Vendors\FormBuilded\FormEditeSouvenir;

class AccepterSouvenirProposer extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier un souvenir");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id = $http->getDataGet("id");
		
        $flash = new Flash();
		$cx		= new Connexion();
        $managerU = new ManagerUser($cx);
        if($managerU->verifUserArticle($id)){
            $manager	= new ManagerArticle($cx);
            $article = $manager->oneArticleById($id);

            if(!is_null($article)){
                $article->setActifArticle(1);
                $article->setValidationArticle(1);
                if($manager->updateArticle($article)){
                    $flash->setFlash("Le souvenir a été accepter !");
                    header("location: afficher-souvenirs-proposer");
                    exit();
                }else{
                    $flash->setFlash("Impossible d'enregistrer le souvenir !");
                    header("location: afficher-souvenirs-proposer");
                    exit();
                }
            }
            $cx->close();
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}


		


