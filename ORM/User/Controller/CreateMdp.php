<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormMdp;
use Vendors\Flash\Flash;


class CreateMdp extends Controller {	
	
	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Recréer un mot de passe");
		$this->setView("ORM/User/View/afficher-form.php");

		$form	= new FormMdp();
		$build	= $form->buildForm();

		if(($form->isSubmit("go"))&&($form->isValid())){
			$http 	= new HTTPRequest();
			$token 	= $http->getDataGet("id");
			$newMdp = $http->getDataPost("pass_user");

			$connexion	= new Connexion();
			$manager	= new ManagerUser($connexion);
			$user 		= $manager->oneUserByTokenValid($token);
			$flash		= new Flash();

			if(!is_null($user)) {
				$user->setPassUser($newMdp);
				$manager->updatePassUser($user);
				$flash->setFlash("Connectez-vous avec 
					ce nouveau mot de passe");
				header("Location: connexion");
				exit();
			}else{
				$flash->setFlash("Délai de réinitialisation expiré. Veuillez 
					renouveler votre demande de mot de passe en cliquant ici : 
					<a href=\"init-mdp\" title=\"Réinitialiser\">
					Mot de passe oublié</a>"
				);
			}


			$connexion->close();
		}

		return $build;
	}

	
}
