<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormConnexion;
use Vendors\Flash\Flash;
use Vendors\LandingPage\LandingPage;

class ConnecterCompte extends Controller {

	function getResult() {
		$this->setLayout("front");
		$this->setTitle("Connexion");
		$this->setView("ORM/User/View/afficher-form.php");

		$form = new FormConnexion();
		$build = $form->buildForm();

		if(($form->isSubmit("connexion"))&&($form->isValid())){
			//Traitement final
			$http 		= new HTTPRequest();
			$login 	 	= $http->getDataPost("email_user");
			$pass 	 	= $http->getDataPost("pass_user");

			$cx 			= new Connexion();
			$manager 	= new ManagerUser($cx);
			$user 		= $manager->connectUser($login,$pass);

			if(is_null($user)){
				$flash = new Flash();
				$flash->setFlash("Impossible de se connecter 
					avec ces identifiants !");
				sleep(3);
			}else{
				$_SESSION["auth"]["id"] 		= $user->getIdUser();
				$_SESSION["auth"]["statut"] = $user->getStatutUser();
				$_SESSION["auth"]["nom"] 		= $user->getNomUser();
				$_SESSION["auth"]["prenom"] = $user->getPrenomUser();
				$_SESSION["auth"]["pseudo"] = $user->getPseudoUser();
				$_SESSION["auth"]["avatar"] = $user->getAvatarUser();

				$page = new LandingPage();
				if($page->existPage()){
					header("Location: ".$page->getPage());
				}else{
					header("Location: afficher-tribu");
				}


			}

			$cx->close();
		}
		return $build;
	}
}