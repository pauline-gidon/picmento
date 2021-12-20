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
            //pour eviter les attaque de force brut on utilise recaptcha
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
                
                   die("empty response");
                   
                }else{
                
                    $data = json_decode($response);
                    
                    if($data->success){ // pas un spam, on traite le formulaire
                    
                        // Traitement final
                        		
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
                    
                    
                }else{//data success
                    #header('Location: index.php');
                    die("erreur verif antispam");
                }
                // ----------------------------------------------
                // -------------------------------------------------------------
		    }   
	    }//if submit go
        return $build;
    }
}