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
use Vendors\FormBuilded\FormDemande;
use ORM\Article\Model\ManagerArticle;
use ORM\Message\Model\ManagerMessage;
use Vendors\FormBuilded\FormAssociation;


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
           $general["user"] = [];
            //si elle sont pas null je parcour le tableau d'amis
            foreach($amis as $ami){
                
                if($ami->getUserIdExpediteur() !== $moi){
                        //je pushe des ituliisateur avec son id
                        $user = $managerU->oneUserById($ami->getUserIdExpediteur()); 
                    }else{
                        $user = $managerU->oneUserById($ami->getUserIdDestinataire()); 
                    }


                $wrapUser = [ 
                    "demande_amis" => $ami,
                    "user-amis" => $user,
                  
                ];
                    array_push($general["user"],$wrapUser);
            }            
            


        }else{
            $flash->setFlash("Vous n'avez pas encore d'ami(s), lancez-vous faite des demandes !");
            
        }
        $managerA = new ManagerArticle($cx);
        // je vais recupéré les proposition de souvenirs qui sont en validation zero
        $souvenirs = $managerA->fullArticlesValidationZero();
        if(!is_null($souvenirs)){
            //je compte le nombre de resultat
            $numsouvenir = count($souvenirs);
            $general["souvenirs"]["objs"] = $souvenirs;
            $general["souvenirs"]["nb"] = $numsouvenir;
        }else{
            $general["souvenirs"]["nb"] = 0;
        }
        
        $managerM = new ManagerMessage($cx);
		
		$messages = $managerM->fullMessagesNonLu();
        if(!is_null($messages)){
            //je compte le nombre de messace recu pas lu

            $nummessage = count($messages);
            $general["message"]["objs"] = $messages;
            $general["messages"]["nb"] = $nummessage;

        }else{
            $general["messages"]["nb"] = 0;
        }
        $cx->close();
        return $general;
    }
}