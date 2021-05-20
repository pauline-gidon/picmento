<?php
namespace ORM\User\Controller;
use DateTime;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
use ORM\Amis\Entity\Amis;

use ORM\User\Entity\User;
use ORM\Amis\Model\ManagerAmis;
use ORM\User\Model\ManagerUser;
// use ORM\Tribu\Model\ManagerTribu;
use ORM\Tribu\Model\ManagerTribu;
use Vendors\AutoMailer\AutoMailer;
use Vendors\FormBuilded\FormAssociation;


class AssocierParentTribu extends Controller {

	function getResult(){
		$this->setLayout("back");
		$this->setTitle("Associer un parent");
		$this->setView("ORM/User/View/afficher-form.php");

        $flash 			= new Flash();
		$http 	= new HTTPRequest();
		$id_tribu 	= $http->getDataGet("id");
        $cx = new Connexion();
        $manager	= new ManagerTribu($cx);
        // je recupère la tribu par son id
		$tribu 		= $manager->oneTribuById($id_tribu);
        //je recupère l'id du user connecter
        $id_user = $_SESSION["auth"]["id"];
        //je verifie si c'est bien le parent1 de connecter
        if($tribu->getUserIdParent1() == $id_user){

            $managerU = new ManagerUser($cx);
            //je verifier et recupère son profil en bdd
            $userExp = $managerU->oneUserById($id_user);
            $id_userExp = $id_user; 
            //je verifie avec cet id de tribu  si une demande amis existe en bdd 
            $managerAmis = new ManagerAmis($cx);
            $amis = $managerAmis->oneAmisByIdTribu($id_tribu);
    
    
            if(!is_null($amis)){
                //si elle existe demander une annulation si actif_amis est a zero
                $actif = $amis->getActifAmis();
                if($actif == 0){
                    header("Location: annuler-demande-".$id_tribu."");
                }else{
                    $flash->setFlash("Désolé un parent est déjà associé à cette tribu, il ne peut pas être remplacé !");
                }            
            }else{
                //sinon j'envoie le formulaire
                $form 	= new FormAssociation();
                $build 	= $form->buildForm();
                $flash->setFlash("<i class=\"fas fa-exclamation-triangle\"></i> Vous ne pourrez pas changer de parent si l'invitation envoyé est accepter !! ¯\_(ツ)_/¯");
                if(($form->isSubmit("go"))&&($form->isValid())){
                    $emailDest = $http->getDataPost("email_user");
                    $new_user = new User([
                        "email_user" 	=> $emailDest
                    ]);
                    //je regarde si un user existe avec ce mail
                    //si c'est null ( pas de user avec ce mail )
                    if(is_null($managerU->userExist($new_user->getEmailUser()))){ 
                        //  crée cet user juste avec son mail et je recupère son id a l'insertion pour alimenté la demande d'amis
                        $id_userDest = $managerU->insertEmailUserInvitation($emailDest);
    
                    }else{
                        //je recupère son id pour alimenté la demande d'amis
                        $user = $managerU->userExist($new_user->getEmailUser());
                        $id_userDest = $user->getIdUser();
                    }
             
                
                    // je crée une demande amis
                    $token 			= time().rand(1000000,9000000);
                    $date 			= new DateTime();
                    $date->setTimestamp(strtotime("+6 month")); 
                    $validity_token = $date->format("Y-m-d H:i:s");
                    
    
                    $new_amis = new Amis([
                        'user_id_expediteur'    => $id_userExp,
                        'user_id_destinataire'  => $id_userDest, 
                        'tribu_id_tribu'        => $id_tribu,
                        'validity_token_tribu'   => $validity_token,
                        'token_tribu'            => $token
                    ]);
                    // je recupère les information du user pour personalisé la demande d'association a être parent
                    $nom = $userExp->getNomUser();
                    $prenom = $userExp->getPrenomUser();
                    if($managerAmis->insertAmisTribu($new_amis) > 0){
                        // j'envoie un mail avec un lien pour association avec l'AutoMailer
                        $automailer = new AutoMailer(
                            $emailDest,
                            "Invitation pour une association de tribu",
                            "
                            <h1>Invitation pour une association de tribu</h1>
                            <p>
                                <img src=\"https://picmento.fr/templates/front/images/logo-picmento.png\" 
                                alt=\"Logo picmento\">
                            </p>
                            <p>".$prenom." ".$nom." vous invite à être le 2eme parent pour sa tribu.</p>
                            <p>Pour voir l'invitation, veuillez cliquer sur ce lien : </p>
                            <p>
                                <a 
                                href=\"https://picmento.fr/acceptation-".$token."\" 
                                title=\"Acceptation invitation\">
                                Ouvrir l'invitation
                                </a>
                            </p>
                            "
                        );
    
                        if($automailer->sendMail()){
                            //Allez voir votre mail d'activation
                            $flash->setFlash("Votre demande à bien été envoyé !");
                            header("location: afficher-tribu");
                            exit();
                        }else{
                            //Erreur mail pas parti
                            $flash->setFlash("Pb lors de l'envoi du mail. Veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
                        }
                    }
                } //if go formulaire
    
    
            // il va recevoir el lien clicer sur le mail et un autre controller prend le relait ne pas oublier de dire que c'est trop lent si il y a mi 6 mois lol
    
            $cx->close();
            return $build;
    
            }//else demande amis null
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}
