<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;
use ORM\User\Model\ManagerUser;
use Vendors\Flash\Flash;

class SuppressionCompte extends Controller {
	function getResult(){
		$this->setLayout("back");
		$this->setTitle("Supprimer votre compte");
		$this->setView("ORM/User/View/supprimer.php");

		$flash		= new Flash();
		$connexion	= new Connexion();
		$manager	= new ManagerUser($connexion);

		$user		= $manager->oneUserById($_SESSION["auth"]["id"]);

		if($manager->deleteUser($user)){
			$flash->setFlash("Compte définitivement supprimé");
			unset($_SESSION["auth"]);
			header("Location: connexion");
			exit();
		}else{
			$flash->setFlash("Problème lors de la suppression, 
			veuillez contacter un administrateur ou renouveler ultérieurement.");
		}	
	}
}
