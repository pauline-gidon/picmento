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


class MessageLu extends Controller {

	function getResult() {
        
		$http 			= new HTTPRequest();
		$id_message 		= json_decode($http->getDataPost("s",1));

		$cx 				= new Connexion();
		$manager 		= new ManagerMessage($cx);
        $message = $manager->oneMessageById($id_message);
        if(!is_null($message)){
            if(is_null($message->getLuMessage())){
                $message->setluMessage(1);
                $manager->messageLu($message);
	        	$messages = $manager->fullMessages();
            }

        }

		$cx->close();
    }
}


		


