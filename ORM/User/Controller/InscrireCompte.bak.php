<?php
namespace ORM\User\Controller;
use Datetime;
use OCFram\Connexion;
use OCFram\Controller;

use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\User\Entity\User;

use ORM\Amis\Model\ManagerAmis;
use ORM\User\Model\ManagerUser;
use Vendors\AutoMailer\AutoMailer;
use Vendors\FormBuilded\FormInscription;


class InscrireCompte extends Controller {

	function getResult() {
		$this->setLayout("front");
		$this->setTitle("Inscription");
		$this->setView("ORM/User/View/afficher-form.php");
        
        $cx 			= new Connexion();
        $manager 	= new ManagerUser($cx);
        if(isset($_SESSION["token"])){
            $token= $_SESSION["token"];
            // var_dump($token);

            $managerAmis   = new ManagerAmis($cx) ;
            $amis = $managerAmis->oneAmisByToken($token);
            $id_dest = $amis->getUserIdDestinataire();
            $user = $manager->oneUserById($id_dest);
            $form = new FormInscription("post",$user,"inscription#zone-form");
            $build = $form->buildForm($user);
        }else{

            $form = new FormInscription("post",NULL,"inscription#zone-form");
            $build = $form->buildForm();
        }
        // var_dump($user);
        


		if(($form->isSubmit("inscription"))&&($form->isValid())){
			//Traitement final
			$flash 			= new Flash();
			$http 			= new HTTPRequest();
			$date 			= new DateTime();
			$date_crea 	= $date->format("Y-m-d H:i:s");
			
			$token 			= time().rand(1000000,9000000);
			$date->setTimestamp(strtotime("+15 minutes")); //+ 1 day, +3 hours, +1 month
			$date_token = $date->format("Y-m-d H:i:s");

			$new_user = new User([
				"nom_user" 							=> $http->getDataPost("nom_user"),
				"prenom_user" 					=> $http->getDataPost("prenom_user"),
				"pseudo_user" 					=> $http->getDataPost("pseudo_user"),
				"email_user" 						=> $http->getDataPost("email_user"),
				"pass_user" 						=> $http->getDataPost("pass_user"),
				"actif_user" 						=> 0,
				"statut_user" 					=> 0,
				"rgpd_user" 						=> true,
				"date_rgpd_user" 				=> $date_crea,
				"token_user" 						=> $token,
				"validity_token_user" 	=> $date_token
			]);
			//Est-ce bien un nouveau User ? 
			$user 		= $manager->userExist($new_user->getEmailUser());
			if(!is_null($user)){
				//La personne avait déjà un compte actif avec cet email sur notre plateforme
				//On va la rediriger vers mot de passe oublié
                $actif = $user->getActifUser();
                if($actif == 1){
                    $flash->setFlash("Si vous avez oublié votre mot de passe, veuillez le réinitialiser.");
                    header("Location: mot-passe-oublie");
                    exit();
                }else{
                    // sinon il lui demande d'aller l'activé avec le mail précédemment envoyé
                    $flash->setFlash("Un compte existe déjà avec ce mail il n'as pas encore été activé, merci de rendez-vous dans votre boit mail pour activez votre compte. <a 
                    href=\"https://picmento.fr/connexion\" 
                    title=\"connexion\">Connexion
                    </a>");
                }
			}else{
				//Personne n'a encore de compte chez nous avec cet email
				//On va lui en créer un

				//1° Manager => un INSERT => id
				if($manager->insertUser($new_user) > 0){
					//Envoyer un mail automatique avec le lien d'activation
					$automailer = new AutoMailer(
						$new_user->getEmailUser(),
						"Creation de votre compte",
						"
						<h1>Création de compte</h1>
						<p>
						<img src=\"https://picmento.fr/templates/front/images/logo-picmento.png\" 
						alt=\"Logo picmento\">
						</p>
						<p>Votre demande de création de compte a 
						été enregistrée.</p>
						<p>Pour finaliser votre inscription, 
						veuillez cliquer sur ce lien :</p>
						<p>
						<a 
						href=\"https://picmento.fr/activation-".$token."\" 
						title=\"Activer le compte\">
						http://picmento.fr/activation-".$token."
						</a>
						</p>
						"
					);
					//...
					if($automailer->sendMail()){
						//Allez voir votre mail d'activation
						$flash->setFlash("Un mail d'activation vous a été envoyé. Vous disposez de 15 minutes pour confirmer la création de 
							votre compte. Il est possible que ce mail soit dans vos 
							spams ou messages indésirables.");
						header("Location: connexion");
						exit();
					}else{
						//Erreur mail pas parti
						$flash->setFlash("Pb lors de l'envoi du mail d'activation. 
						Veuillez contacter le webmaster.");
					}

				}else{
					//Insert échoué donc message
					$flash->setFlash("Echec lors de la création de votre 
					compte. Veuillez renouveler ultérieurement  ou 
					 contacter le webmaster.");
				}
			}

			$cx->close();

		}//Fermeture du if isSubmit && isValid
		return $build;
	}
}