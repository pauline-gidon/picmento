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

		$this->setLayout("Back");
		$this->setTitle("Mes amis");
		$this->setView("ORM/Amis/View/amis.php");

        $flash 			= new Flash();

        // je recupère les demande d'amis validé
        $cx = new Connexion();
        $managerA = new ManagerAmis($cx);
        $managerU = new ManagerUser($cx);
        $amis = $managerA->fullAmisActif();
        // var_dump($amis);
        //si elle sont pas null je parcour le tableau d'amis
        if(!is_null($amis)){

            foreach($amis as $ami){
                $id_exps = $ami->getUserIdExpediteur();
                $id_dests = $ami->getUserIdDestinataire();

                    if($id_exps = $_SESSION["auth"]["id"]){
                        $user = $managerU->oneUserById($id_dests);
                    }
                
                    if($id_dests = $_SESSION["auth"]["id"]){
                        $user = $managerU->oneUserById($id_exps);
                    }
                    var_dump($user);
                    
                
                
            }            
            
            // return $users;
        }else{
            $flash->setFlash("Vous n'avez pas encore d'amis, lancez vous faite des demandes !");
        }
        $cx->close();
    }
}