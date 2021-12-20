<?php
namespace ORM\Signalement\Controller;
use DateTime;
use Vendors\Cryptor;
use OCFram\Connexion;


use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;

use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Signalement\Entity\Signalement;
use Vendors\FormBuilded\FormSignalement;
use ORM\Signalement\Model\ManagerSignalement;

class GererSignalement extends Controller {
	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Tous les signalements");
		$this->setView("ORM/Signalement/View/all-signalements.php");
        $flash = new Flash();
        $http = new HTTPRequest();
        $cx = new Connexion();


        // est-ce que la personne connecter a bien un niveau 3
        if($_SESSION["auth"]["statut"] == 3){
            $manager = new ManagerSignalement($cx);
            $signalements = $manager->fullSignalement();
            var_dump($signalements);
            if(is_null($signalements)){
                $flash->setFlash("Vous n'avez pas de signalement(s) à traiter !");
            }
        
            return $signalements;
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }





        $cx->close();
    }
}

		


