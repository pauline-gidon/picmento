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
use ORM\Tribu\Model\ManagerTribu;
use Vendors\AutoMailer\AutoMailer;
use Vendors\FormBuilded\FormAssociation;
use Vendors\FormBuilded\FormDemande;


class AfficherAmis extends Controller {

	function getResult(){

		$this->setLayout("back");
		$this->setTitle("Mes amis");
		$this->setView("ORM/Amis/View/amis.php");

        $flash 			= new Flash();

        // je recupère les demande d'amis validé
        $cx = new Connexion();
        $managerA = new ManagerAmis($cx);
        $managerU = new ManagerUser($cx);
        $amis = $managerA->fullAmisActif();
        $moi = $_SESSION["auth"]["id"];
        if(!is_null($amis)){
            $user_amis = [];
            //si elle sont pas null je parcour le tableau d'amis
            foreach($amis as $ami){
                if($ami->getUserIdExpediteur() !== $moi){
                        array_push($user_amis,$managerU->oneUserById($ami->getUserIdExpediteur())); 
                }else{
                        array_push($user_amis,$managerU->oneUserById($ami->getUserIdDestinataire())); 
                }
                
                
                
            }            
            
            $cx->close();
            return $user_amis;
        }else{
            $flash->setFlash("Vous n'avez pas encore d'amis, lancez-vous faite des demandes !");
            
        }
    }
}