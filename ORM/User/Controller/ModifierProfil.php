<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Entity\User;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormProfil;
use Vendors\Flash\Flash;

use DateTime;


class ModifierProfil extends Controller {

	function getResult(){
		$this->setLayout("back");
		$this->setTitle("Modifier votre profil");
		$this->setView("ORM/User/View/afficher-form.php");

		$connexion	= new Connexion();
		$manager	= new ManagerUser($connexion);
		$user		= $manager->oneUserById($_SESSION["auth"]["id"]);
		

		$form 	= new FormProfil("post",$user);
		$build 	= $form->buildForm();

		//Si soumission d'un form valide (sans erreur)
		if(($form->isSubmit("go"))&&($form->isValid())){
			$flash	= new Flash();
			$http = new HTTPRequest();
			$user->setNomUser($http->getDataPost("nom_user"));
			$user->setPrenomUser($http->getDataPost("prenom_user"));
			$user->setPseudoUser($http->getDataPost("pseudo_user"));
			$user->setEmailUser($http->getDataPost("email_user"));
			$user->setPassUser($http->getDataPost("pass_user"));

			if($manager->oneUserByIdAndPass($user)){
				//La modif
				if($manager->updateProfil($user)){
					$_SESSION["auth"]["statut"] 	= $user->getStatutUser();
					$_SESSION["auth"]["nom"] 			= $user->getNomUser();
					$_SESSION["auth"]["prenom"] 	= $user->getPrenomUser();
					$_SESSION["auth"]["pseudo"] 	= $user->getPseudoUser();
					
					$flash->setFlash("Modification ok <a href=\"espace-perso\" title=\"retour espace perso\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");
				}else{
					$flash->setFlash("Vous n'avez pas fait de modification <a href=\"espace-perso\" title=\"retour espace perso\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");
				}

			}else{
				//Attention pas le bon mdp
				$flash->setFlash("Mot de passe incorrect");
			}
			
			
		}//Fin de la soumission

		$connexion->close();

		return $build;

	}

}

