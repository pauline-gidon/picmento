<?php
namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\Article\Model\ManagerArticle;
// use ORM\Article\Entity\Article;
use ORM\Baby\Model\ManagerBaby;

use Vendors\Flash\Flash;
use OCFram\Navbaby;

class AfficherSouvenirsBaby extends Controller {

	use Navbaby;

	function getResult() {
		$http 				= new HTTPRequest();
		$id_baby 	= $http->getDataGet("id");
		$cx			= new Connexion();
		$manager1	= new ManagerBaby($cx);
		
		$babys=  $manager1->allBabyHasUser();
		$this->navConstruction($babys);
		$baby = $manager1->oneBabyById($id_baby);
		$nom = $baby->getNomBaby();
		$general[] = $baby;
		$this->setLayout("back");
		$this->setTitle("Les souvenirs");
		$this->setView("ORM/Article/View/afficher-souvenirs-baby.php");
		
		$cx = new Connexion();
		$manager = new ManagerArticle($cx);
        
		$articles = $manager->fullArticle($id_baby);
        // var_dump($articles);die();
        //il faudra que je gère l'affichage des commantire $generale[] = $commentaires
		if(is_null($articles)){
			$flash = new Flash;
			$flash->setFlash("Votre enfant n'a pas encore de souvenir, lancez-vous !");
		}else{

			$general[] = $articles;
		}
		// var_dump($articles);die();
		
		return $general;
		

		
			
	}
}


		


