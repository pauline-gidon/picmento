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
            //si la personne arrive sur la creation de compte grace a une invitation
            //je remplit le champ mail
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
        
        if(($form->isSubmit("inscription"))&&($form->isValid())){
        // recaptcha ======================================================================
        // On vérifie si curl est installé
        if(function_exists('curl_version')){
         $data = array(
            'secret' => CAPTCHAKEYSECRET,
            'response' => $_POST['recaptcha-response'],
        );
    
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        }
 
         // On vérifie qu'on a une réponse
         if(empty($response) || is_null($response)){
            //  header('Location: index.php');
            die("empty response");
         }else{
             $data = json_decode($response);
             if($data->success){ // pas un spam, on traite l'inscription
                # ---
                // Traitement final
                $flash 			= new Flash();
                $http 			= new HTTPRequest();
                $date 			= new DateTime();
                $date_crea 	= $date->format("Y-m-d H:i:s");
                
                $token 			= time().rand(1000000,9000000);
                $date->setTimestamp(strtotime("+1 day")); //+ 1 day, +3 hours, +1 month, + 15 minutes
                $date_token = $date->format("Y-m-d H:i:s");

                $new_user = new User([
                    "nom_user" 							=> $http->getDataPost("nom_user"),
                    "prenom_user" 					=> $http->getDataPost("prenom_user"),
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
                    }elseif($actif === NULL) {
                        // creation de compte à partir d'une invitation ami
                        if($manager->updateProfilCreation($new_user)){
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
                                $flash->setFlash("Un email d'activation vous a été envoyé. Vous disposez de 24h pour confirmer la création de votre compte. Il est possible que ce mail soit dans vos 
                                    spams ou messages indésirables.");
                                header("Location: connexion");
                                exit();
                            }else{
                                //Erreur mail pas parti
                                $flash->setFlash("Problème lors de l'envoi du mail d'activation. 
                                Veuillez contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
                            }

                        }else{
                            //Insert échoué donc message
                            $flash->setFlash("Echec lors de la création de votre 
                            compte. Veuillez renouveler ultérieurement  ou 
                            contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
                        }

                        


                    }else{ // elseif($actif === NULL
                        // nouveau compte qui n'a pas encore cliqué par le lien du mail
                        $flash->setFlash("Un compte existe déjà mais n'a pas encore été activé. Cliquez sur le lien reçu par email pour l'activer. <a 
                        href=\"https://picmento.fr/connexion\" 
                        title=\"connexion\">Connexion
                        </a>
                        <a href=\"nouvelle-activation\" title=\"Nouveau mail\" >(si vous n'avez rien reçu cliquez-ici)</a>");
                    }
                }else{ // if(!is_null($user))
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
                            $flash->setFlash("Un email d'activation vous a été envoyé. Vous disposez de 24h pour confirmer la création de 
                                votre compte. Il est possible que ce mail soit dans vos 
                                spams ou messages indésirables.");
                            header("Location: connexion");
                            exit();
                        }else{
                            //Erreur mail pas parti
                            $flash->setFlash("Pb lors de l'envoi du mail d'activation. 
                            Veuillez contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
                        }

                    }else{
                        //Insert échoué donc message
                        $flash->setFlash("Echec lors de la création de votre 
                        compte. Veuillez renouveler ultérieurement  ou 
                        contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
                    }
                }

                $cx->close();
                # ---
             }else{
                 #header('Location: index.php');
                 die("erreur verif antispam");
             }
         } // recaptcha
     
            
     	}//Fermeture du if isSubmit && isValid
		return $build;
	} // fonction getresult()
} // controller