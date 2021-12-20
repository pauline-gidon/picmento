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
use ORM\User\Model\ManagerUser;
use Vendors\FormBuilded\FormAmi;
use Vendors\AutoMailer\AutoMailer;


class SupprimerAmi extends Controller {

	function getResult(){

		$this->setLayout("back");
		$this->setTitle("Supprimer amis");
		$this->setView("ORM/User/View/afficher-form.php");
        $http 	= new HTTPRequest();

        $flash 			= new Flash();

        //je recupère l'id du user amis
        $id_ami 	= $http->getDataGet("id");
        //je recupère l'id du user connecter
        $id_user = $_SESSION["auth"]["id"];
        $cx = new Connexion();
        $managerU = new ManagerUser($cx);
        //la personn eveut supprimer leur relation je vais donc devoir supprimer la relation amis et la relation user has user avec les 2 id
        $managerA = new ManagerAmis($cx);
        if($managerA->deleteAmisByIds($id_ami,$id_user)==TRUE && $managerU->deleteUserHasUser($id_ami,$id_user)==TRUE){

            $flash->setFlash("Votre ami(e) a bien été supprimé ! ");
            header("location: amis");
            exit();
        }
    }
}