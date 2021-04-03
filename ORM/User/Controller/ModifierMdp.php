<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormModifierMdp;
use Vendors\Flash\Flash;

use DateTime;

class ModifierMdp extends Controller {

	function getResult(){

		$this->setLayout("back");
		$this->setTitle("Modifiez votre mot de passe");
		$this->setView("ORM/User/View/afficher-form.php");

		$form 	= new FormModifierMdp();
		$build 	= $form->buildForm();
		
		if(($form->isSubmit("go"))&&($form->isValid())){
			
			$http_request	= new HTTPRequest();
			$flash 			= new Flash();
			$actualMdp		= $http_request->getDataPost("pass_user1");
			$newMdp			= $http_request->getDataPost("pass_user2");


			
			$connexion = new Connexion();
			$manager	= new ManagerUser($connexion);

			$user		= $manager->oneUserById($_SESSION["auth"]["id"]);
			$user->setPassUser($http_request->getDataPost("pass_user1"));

			if($manager->oneUserByIdAndPass($user)){
				$user->setPassUser($http_request->getDataPost("pass_user2"));
				if($manager->updatePassUser($user)){
					$flash->setFlash("Mot de passe modifié");	
					header("Location: modifier-mdp");
					exit();
				}else{
					$flash->setFlash("Pas de modification");
				}
			}else{
				$flash->setFlash("Merci de renseigner le 
					bon mot de passe actuel");
			}

			$connexion->close();
			
		}

		
		return $build;

	}

}


