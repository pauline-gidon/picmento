<?php
namespace ORM\Amis\Controller;
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
		$this->setTitle("La tribu de mon ami");
		$this->setView("ORM/Amis/View/voir-babys-ami.php");

        $flash 			= new Flash();
        $http 	= new HTTPRequest();
        $cx = new Connexion();
		$user_amis 	= $http->getDataGet("id");
        $managerU = new ManagerUser($cx);

        if($managerU->verifUserTribuAmis($user_amis)){
            $managerB = new ManagerBaby($cx);
            $babys = $managerB->allBabyAmis($user_amis);
            $cx->close();
            return $babys;
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}