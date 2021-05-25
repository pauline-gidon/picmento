<?php
namespace ORM\Message\Controller;

use DateTime;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use ORM\Message\Entity\Message;
use Vendors\Flash\Flash;
use ORM\Message\Model\ManagerMessage;
use Vendors\FormBuilded\FormMessage;

// use ORM\Tribu\Entity\Tribu;
// use ORM\Baby\Entity\Baby;
// use ORM\Baby\Model\ManagerBaby;


class Repondre extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Envoyez un message");
		$this->setView("ORM/Article/View/afficher-form-simple.php");

		$http 			= new HTTPRequest();
		$id_message = $http->getDataGet("id");
        $flash = new Flash();

		$cx 				= new Connexion();
		$manager 		= new ManagerMessage($cx);
        $message = $manager->oneMessageById($id_message);
        if(!is_null($message)){
            if($message->getUserIdDestinataire() == $_SESSION["auth"]["id"]){
                $form 		= new FormMessage();
                $build 		= $form->buildForm();
                if(($form->isSubmit("go"))&&($form->isValid())){

                    $date_message = new DateTime('NOW');
                    $date_message = $date_message->format("Y-m-d H:i:s");

                    $new_message = new Message([
                        "text_message" 	=> ucfirst($http->getDataPost("text_message")),
                        "date_message" => $date_message,
                        "user_id_expediteur" => $message->getUserIdDestinataire(),
                        "user_id_destinataire" => $message->getUserIdExpediteur(),
                        ]);
            
                        if($manager->insertNewMessage($new_message)){
                            
                            $flash->setFlash("Votre message à bien été envoyer");
                            header("location: afficher-messages-recu");
                            exit();
                        }else{
                            $flash->setFlash("Impossible d'envoyer le message veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
                            header("location: afficher-messages-recu");
                            exit();
                        }
        
                        
                }


                
                return $build;
            }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
        }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
		$cx->close();
    }
}


		


