<?php
namespace ORM\Tribu\Controller;
use DateTime;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\Amis\Entity\Amis;

use ORM\User\Entity\User;
use ORM\Amis\Model\ManagerAmis;
use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use ORM\Tribu\Model\ManagerTribu;
use Vendors\AutoMailer\AutoMailer;
use Vendors\FormBuilded\FormAssociation;
use Vendors\FormBuilded\FormDemande;


class VoirTribuAmis extends Controller {

	function getResult(){

		$this->setLayout("back");
		$this->setTitle("Les tribu de mon ami");
		$this->setView("ORM/Tribu/View/voir-tribu-ami.php");

        $flash 			= new Flash();
        $http 	= new HTTPRequest();
        $cx = new Connexion();
		$id_amis 	= $http->getDataGet("id");
        $_SESSION["ami"]["id"] = $id_amis;
        $managerA = new ManagerAmis($cx);
        //il faut que je verifie si une demande d'ami existe entre le user connecter et le profil amis visité
        $demandeAmis = $managerA->oneAmisByUsersIds($id_amis);

        if(!is_null($demandeAmis)){
            $managerT = new ManagerTribu($cx);
            $tribuBabys = $managerT->fullTribuWithBabys($id_amis);
            if(!is_null($tribuBabys)){

                $cx->close();
                return $tribuBabys;
            }else{
            $flash->setFlash("Votre amis n'a pas encore de tribu !");
            }
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
 
    }
}