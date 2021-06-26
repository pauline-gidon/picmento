<?php
namespace ORM\Message\Controller;

use DateTime;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\Message\Entity\Message;
use ORM\User\Model\ManagerUser;
use Vendors\FormBuilded\FormMessage;
use ORM\Message\Model\ManagerMessage;

// use ORM\Tribu\Entity\Tribu;
// use ORM\Baby\Entity\Baby;
// use ORM\Baby\Model\ManagerBaby;


class EnvoyerMessage extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Envoyez un message");
		$this->setView("ORM/Article/View/afficher-form-simple.php");

		$http 			= new HTTPRequest();
		$id_ami = $http->getDataGet("id");
        $flash = new Flash();

		$cx 				= new Connexion();
		$manager 		= new ManagerMessage($cx);
        $managerU = new ManagerUser($cx);
  
        if($managerU->verifUserAmis($id_ami)){
            // var_dump($message);
            $form 		= new FormMessage();
            $build 		= $form->buildForm();
            if(($form->isSubmit("go"))&&($form->isValid())){

                $date_message = new DateTime('NOW');
                $date_message = $date_message->format("Y-m-d H:i:s");

                $new_message = new Message([
                    "text_message" 	=> ucfirst($http->getDataPost("text_message")),
                    "date_message" => $date_message,
                    "user_id_expediteur" => $_SESSION["auth"]["id"],
                    "user_id_destinataire" => $id_ami,
                    ]);
        
                    if($manager->insertNewMessage($new_message)){
                        
                        $flash->setFlash("Votre message à bien été envoyé !");
                        header("location: amis");
                        exit();
                    }else{
                        $flash->setFlash("Impossible d'envoyer le message, veuillez réessayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
                        header("location: amis");
                        exit();
                    }
    
                    
            }


                    
                    return $build;
            
           
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
		$cx->close();
    }
}


		


