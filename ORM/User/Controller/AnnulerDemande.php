<?php
namespace ORM\User\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;

use Vendors\Flash\Flash;
use ORM\Amis\Model\ManagerAmis;

use ORM\User\Model\ManagerUser;
// use ORM\Tribu\Model\ManagerTribu;
use Vendors\FormBuilded\FormAnnul;

class AnnulerDemande extends Controller {

	function getResult(){
		$this->setLayout("back");
		$this->setTitle("Annuler demande");
		$this->setView("ORM/User/View/form-annule.php");

        //je vais cherche la demande amis dans la table grace au get
        $http 	= new HTTPRequest();
        $flash 			= new Flash();

		$id_tribu 	= $http->getDataGet("id");

        $cx = new Connexion();
        $managerAmis = new ManagerAmis($cx);
        $amis = $managerAmis->oneAmisByIdTribu($id_tribu);
        if(!is_null($amis)){
            // si la demander est annuler il faut recuperer l'id_user_destinataire

            $id_user_dest = $amis->getUserIdDestinataire();
            //je vais cherche cet user en bdd par son id pour un affichage dynamique 
            $managerUser = new ManagerUser($cx);
            $user = $managerUser->oneUserById($id_user_dest);
            $general [] = $user;
    
    
            $form 	= new FormAnnul();
            $build 	= $form->buildForm();
            $flash->setFlash("Une demande a déjà été envoyée a \" ".$user->getEmailUser()." \" mais elle n'a pas encore été acceptée, voulez-vous annuler cette demande pour en faire une nouvelle ?");
            $general [] = $build;
            if(($form->isSubmit("annuler"))&&($form->isValid())){
                $annule = $http->getDataPost('annule');
                // var_dump($annule); die();
                if($annule == 1) {
                    if($managerAmis->deleteAmisByIdTribuAndIdDestinatatire($id_tribu,$id_user_dest)){
                        $flash->setFlash("La demande a bien été annulée, vous pouvez renvoyer une nouvelle demande !");
                        header("location: associer-parent-tribu-".$id_tribu."");
                        exit();
                    }
                }elseif($annule == 0){
                    $flash->setFlash("Votre invitation n'a pas été annulée !");
                    header("location: afficher-tribu");
                    exit();
                }
            }
            $cx->close();
            return $general;
        }else{
            header("location: afficher-tribu");
            exit();
        }
	}
}
