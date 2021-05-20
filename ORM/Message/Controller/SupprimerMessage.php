<?php
namespace ORM\Message\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\Message\Model\ManagerMessage;
// use ORM\Tribu\Entity\Tribu;
// use ORM\Baby\Entity\Baby;
// use ORM\Baby\Model\ManagerBaby;


class SupprimerMessage extends Controller {

	function getResult() {
		$http 			= new HTTPRequest();
		$id_message = $http->getDataGet("id");

		$cx 				= new Connexion();
		$manager 		= new ManagerMessage($cx);
        $message = $manager->oneMessageById($id_message);
        if(!is_null($message)){
            if($manager->deleteMessageById($id_message)){
                header("location: afficher-messages-recu");
                exit();
            }
        }

		$cx->close();
    }
}


		


