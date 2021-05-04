<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormMail;
use Vendors\Flash\Flash;
use Vendors\AutoMailer\AutoMailer;

use DateTime;

class NewMdp extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Mot de passe oublié");
		$this->setView("ORM/User/View/afficher-form.php");

		$form 	= new FormMail();
		$build 	= $form->buildForm();

		if(($form->isSubmit("go"))&&($form->isValid())){
			$http 		= new HTTPRequest();
			$email 	 	= $http->getDataPost("email_user");

			$connexion 	= new Connexion();
			$manager 	= new ManagerUser($connexion);
			$user 		= $manager->userExist($email);
			$flash = new Flash();

			if(!is_null($user)){
				//On tient quelqu'un : on va lui envoyer la procédure
				//de réinitialisation du mot de passe avec token 
				//et durée de validité
				$date 	= new DateTime();
				$token 	= time().rand(1000000,9000000);
				$date->setTimestamp(strtotime("+15 minutes"));
				$date_token = $date->format('Y-m-d H:i:s');

				if($user->getActifUser() == 1){
					$user->setTokenUser($token);
					$user->setValidityTokenUser($date_token);
					$manager->updateTokenUser($user);

					if($connexion->affected_rows == 1){
						//Envoi du mail
						$automailer = new AutoMailer(
							$email,
							"Réinitialisation de votre mot de passe",
							"
							<h1>Réinitialisation de votre mot de passe</h1>
							<p>
							<img src=\"https://picmento.fr/templates/front/images/logo-picmento.png\" 
						alt=\"Logo picmento\">
							</p>
							<p>Pour réinitialiser votre mot de passe, 
							veuillez cliquer sur ce lien :</p>
							<p>
							<a 
							href=\"https://picmento.fr/nouveau-mdp-".$token."\" 
							title=\"Réinitialiser votre mot de passe\">
							https://picmento.fr/nouveau-mdp-".$token."
							</a>
							</p>
							"
						);
						//...
						if($automailer->sendMail()){
							//Allez voir votre mail d'activation
							$flash->setFlash("Un email de réinitialisation vous a été envoyé. Vous disposez de 15 minutes pour vous recréer un mot de passe. Il est possible que ce mail soit dans vos spams ou messages indésirables.");
							
							header("Location: connexion");
							exit();
						}else{
							//Erreur mail pas parti
							$flash->setFlash("Pb lors de l'envoi du mail de réinitialisation. Veuillez contacter le webmaster.");
						}
					}

				}else{
					$flash->setFlash("Vous ne pouvez pas réinitialiser 
						votre mot de passe car vous n'avez pas de compte 
						actif chez nous");
				}
			}else{
				$flash->setFlash("Si cet email existe sur notre plateforme 
				vous recevrez un mail de réinitialisation du mot de passe, 
				sinon créez-vous un compte.");
			}

			$connexion->close();

		}

		return $build;

	}

}


