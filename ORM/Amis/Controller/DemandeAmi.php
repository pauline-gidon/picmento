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
use ORM\Tribu\Model\ManagerTribu;
use Vendors\AutoMailer\AutoMailer;
use Vendors\FormBuilded\FormDemande;
use Vendors\FormBuilded\FormAssociation;


class DemandeAmi extends Controller {

	function getResult(){

		$this->setLayout("back");
		$this->setTitle("Envoyer une demande d'ami");
		$this->setView("ORM/User/View/afficher-form.php");
        $http 	= new HTTPRequest();

        $flash 			= new Flash();

        //je recupère l'id du user connecter
        $id_user = $_SESSION["auth"]["id"];
        //je verifier et recupère son profil en bdd
        $cx = new Connexion();
        $managerU = new ManagerUser($cx);
        $userExp = $managerU->oneUserById($id_user);
        $id_ami_exp = $userExp->getIdUser();
        if(!is_null($userExp)){
            $form 	= new FormAmi();
            $build 	= $form->buildForm();

            if(($form->isSubmit("go"))&&($form->isValid())){
                $emailDest = $http->getDataPost("email_user");

                $user_ami = new User([
                    "email_user" 	=> $emailDest
                ]);
                    //je regarde si ce mail existe dans la bdd
                if(is_null($managerU->userExist($user_ami->getEmailUser()))){ 
                    //  crée cet user
                    //je recupère son id
                    $id_ami_dest = $managerU->insertEmailUserInvitation($emailDest);

                }else{
                    $user = $managerU->userExist($user_ami->getEmailUser());
                    $id_ami_dest = $user->getIdUser();
                    // je verifie si une amis existe et si il on une relation
                }
                
                                // je crée une demande amis
    			$token 			= time().rand(1000000,9000000);
    			$date 			= new DateTime();
                $date->setTimestamp(strtotime("+6 month")); 
                $validity_token = $date->format("Y-m-d H:i:s");
                
                // $id_userDest = $userDest->getIdUser();

                $new_amis = new Amis([
                    'user_id_expediteur'    => $id_ami_exp,
                    'user_id_destinataire'  => $id_ami_dest, 
                    'validity_token_tribu'   => $validity_token,
                    'token_tribu'            => $token
                ]);
                $nom = $userExp->getNomUser();
                $prenom = $userExp->getPrenomUser();
                $managerAmis = new ManagerAmis($cx);

                if($managerAmis->insertAmis($new_amis) > 0){
                    // j'envoie un mail avec un lien pour association avec l'AutoMailer
					$automailer = new AutoMailer(
						$emailDest,
						"Demande d'ami",
						"
						<h1>Demande d'ami</h1>
						<p>
                            <img src=\"https://picmento.fr/templates/front/images/logo-picmento.png\" 
                            alt=\"Logo picmento\">
						</p>
						<p>".$prenom." ".$nom." vous invite à voir sa tribu. </p>
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
                        header("location: amis");
                        exit();
					}else{
						//Erreur mail pas parti
						$flash->setFlash("Pb lors de l'envoi du mail. Veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
					}


                    
                    
                    
                }


            }
            $cx->close();
            return $build;


        }
    }
}