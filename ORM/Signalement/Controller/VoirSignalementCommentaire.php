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

class VoirSignalementCommentaire extends Controller {
	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Voir signalement commentaire");
		$this->setView("ORM/Signalement/View/voir-signalement.php");
        $flash = new Flash();
        $http = new HTTPRequest();
		$id_com_chiffre = $http->getDataGet("id");
        $cryptor = new Cryptor();

        $id_com = $cryptor->decrypt($id_com_chiffre);
		$cx			= new Connexion();
        $managerM = new ManagerCommentaire($cx);
        $com = $managerM->oneCommentaireById($id_com);

        // est-ce qu'il existe ce commentaire en bdd avec cet id
        if(!is_null($com)){
            $general["com"] = $com;
            $id_com = $com->getIdCommentaire();
            $managerS = new ManagerSignalement($cx);

            $signalement = $managerS->oneSignalementCommentaire($id_com);
            $general["signalement"] = $signalement;

            $cx->close();
            return $general;

        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}

		


