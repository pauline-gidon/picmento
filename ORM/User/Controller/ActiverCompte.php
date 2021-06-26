<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;
use ORM\Tribu\Model\ManagerTribu;

use Vendors\Flash\Flash;


class ActiverCompte extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Activez votre compte");
		$this->setView("ORM/User/View/afficher-form.php");

		$http 	= new HTTPRequest();
		$token 	= $http->getDataGet("id");

		$connexion 	= new Connexion();
		$manager 	= new ManagerUser($connexion);
		$flash 		= new Flash();
        // var_dump($token); die();

		$user = $manager->oneUserByTokenValid($token);
		if(!is_null($user)){
			$user->setStatutUser(1);
			$user->setActifUser(1);
			$manager->updateActivationUser($user);
			$flash->setFlash("Compte activé, merci de vous connecter !");
			$manager = new ManagerTribu($connexion);
			$manager->insertTribu();
			header("Location: connexion");
			exit();
		}else{
			$flash->setFlash("Trop lent ! Merci de cliquer 
			pour recevoir un <a href=\"nouvelle-activation\" 
			title=\"Nouveau mail\">nouveau mail</a> d'activation. 
			");
		}

		$connexion->close();
	}

}
