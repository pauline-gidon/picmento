<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\User\Model\ManagerUser;

use Vendors\Flash\Flash;
use Vendors\FormBuilded\FormMail;
use Vendors\AutoMailer\AutoMailer;

use DateTime;

class NewActivation extends Controller {	

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Recevoir un nouveau mail d'activation");
		$this->setView("ORM/User/View/afficher-form.php");

		$form 	= new FormMail("post",NULL,"nouvelle-activation#toto");
		$build 	= $form->buildForm();

		if(($form->isSubmit("go"))&&($form->isValid())){
			//OK POUR LE TRAITEMENT FINAL
			$http 	= new HTTPRequest();
			$mail		= $http->getDataPost("email_user");
			$flash 	= new Flash();
			$date 	= new DateTime();
			$token 	= time().rand(1000000,9000000);
			$date->setTimestamp(strtotime("+15 minutes"));
			$date_token = $date->format('Y-m-d H:i:s');

			$connexion	= new Connexion();
			$manager	= new ManagerUser($connexion);
			$user 		= $manager->userExist($mail);
			if(!is_null($user)){
				//GETTER : statut, actif
				if(($user->getStatutUser() == 0)&&($user->getActifUser() == 0)){
					$user->setTokenUser($token);
					$user->setValidityTokenUser($date_token);
					if($manager->updateTokenUser($user)){
						//Envoi du mail
						$automailer = new AutoMailer(
							$mail,
							"Creation de votre compte",
							"
							<h1>Création de compte</h1>
							<p>
							<img src=\"https://picmento.fr/templates/front/images/logo-picmento.png\" 
							alt=\"Logo picmento\">
							</p>
							<p>Voici votre nouveau mail d'activation.</p>
							<p>Pour finaliser votre inscription, 
							veuillez cliquer sur ce lien :</p>
							<p>
							<a 
							href=\"https://picmento.fr/activation-".$token."\" 
							title=\"Activer le compte\">
							https://picmento.fr/activation-".$token."
							</a>
							</p>
							"
						);
						//...
						if($automailer->sendMail()){
							//Allez voir votre mail d'activation
							$flash->setFlash("Un mail d'activation vous a été envoyé. Vous disposez de 15 minutes pour confirmer la création de votre compte. Il est possible que ce mail soit dans vos spams ou messages indésirables.");
							header("Location: connexion");
							exit();
						}else{
							//Erreur mail pas parti
							$flash->setFlash("Pb lors de l'envoi du mail d'activation. Veuillez contacter le webmaster.");
						}
					}else{
						$flash->setFlash("Pb, contactez le webmaster.");
					}
				}else{
					$flash->setFlash("Connectez-vous ou utilisez la 
						fonction mot de passe oublié.");
					header("Location: connexion");
					exit();
				}
			}else{
				$flash->setFlash("Créez vous un compte.");
				header("Location: inscription");
				exit();
			}

			$connexion->close();
		}
		//Fin de la soumission

		//--
		return $build;
	}

}
