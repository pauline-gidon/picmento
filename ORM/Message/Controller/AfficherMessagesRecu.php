<?php
namespace ORM\Message\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use Vendors\Flash\Flash;
use ORM\Article\Model\ManagerArticle;
use ORM\Message\Model\ManagerMessage;
use ORM\User\Model\ManagerUser;

// use ORM\Tribu\Entity\Tribu;
// use ORM\Baby\Entity\Baby;
// use ORM\Baby\Model\ManagerBaby;


class AfficherMessagesRecu extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Messagerie");
		$this->setView("ORM/Message/View/afficher-messages-recu.php");

        $flash = new Flash;
		$cx = new Connexion();
        $managerM = new ManagerMessage($cx);
		$messages = $managerM->fullMessages();
        if(!is_null($messages)){
            $general=[];
            foreach($messages as $message){
                $boite=[
                    "exp" => [],
                    "contenu" => [],
                ];
                $id_exp = $message->getUserIdExpediteur();
                $managerU = new ManagerUser($cx);
                $user_exp = $managerU->oneUserById($id_exp);
                
                array_push($boite["contenu"], $message);
                array_push($boite["exp"], $user_exp);
                array_push($general, $boite);
            }
            return $general;
        }else{
            $flash->setFlash("Vous n'avez aucun message !");
            header("location: afficher-messages");
            exit();
        }
    $cx->close();
    }
}


		


