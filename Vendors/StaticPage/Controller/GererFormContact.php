<?php
namespace Vendors\StaticPage\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\User\Model\ManagerUser;
use Vendors\AutoMailer\AutoMailer;
use Vendors\FormBuilded\FormContact;

class GererFormContact extends Controller {

	function getResult() {
        if(isset($_SESSION["auth"])){
            $this->setLayout("back");
        }else{
            $this->setLayout("front");
        }
		$this->setTitle("Contact");
		$this->setView("Vendors/StaticPage/View/afficher-contact.php");

        $cx 			= new Connexion();
        $manager 	= new ManagerUser($cx);
        $flash      = new Flash();

        if(isset($_SESSION["auth"])){
            $id_user= $_SESSION["auth"]["id"];
            //je remplit le champ mail
            $user = $manager->oneUserById($id_user);
            $form = new FormContact("post",$user);
            $build = $form->buildForm($user);



        }else{

            $form = new FormContact();
            $build = $form->buildForm();   
        
        }

		if(($form->isSubmit("go"))&&($form->isValid())){
			//Traitement final
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
       
               
        
                // On vérifie qu'on a une réponse
                if(empty($response) || is_null($response)){
                   die("empty response");
                }else{
                    $data = json_decode($response);
                    if($data->success){ // pas un spam, on traite le formulaire
                       # ---
                       // Traitement final
                       
                       $http 			= new HTTPRequest();
                       $automailer = new AutoMailer(
                        "pauline@picmento.fr",
                        $http->getDataPost("objet"),
                        "
                        <h1>Message de : ".$http->getDataPost("email")."</h1>
                        <p>".$http->getDataPost("message")."</p>",
                        $http->getDataPost("email")
                    );
                    //...
                        if($automailer->sendMail()){
                            //Allez voir votre mail d'activation
                            $flash->setFlash("Votre message à bien été envoyé. Nous vous recontacterons.");
                            if(isset($_SESSION["auth"])){
                                header("Location: afficher-tribu" );
                                exit();
                            }else{
                                header("Location: index.php" );
                                exit();
                            }
                        }else{
                            //Erreur mail pas parti
                            $flash->setFlash("Problème lors de l'envoi du mail merci de réessayer !");
                           
                        }

                    
       
       
                       
       
                       $cx->close();
                       # ---
                    }else{//data success
                        #header('Location: index.php');
                        die("erreur verif antispam");
                    }
                } // recaptcha response
            }
		}//if submit go


		return $build;
	}

}