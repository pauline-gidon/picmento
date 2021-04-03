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
use Vendors\AutoMailer\AutoMailer;
use Vendors\FormBuilded\FormAssociation;


class AssocierParentTribu extends Controller {

	function getResult(){
		$this->setLayout("front");
		$this->setTitle("Associer un parent");
		$this->setView("ORM/User/View/afficher-form.php");

        $flash 			= new Flash();
		$http 	= new HTTPRequest();
		$id_tribu 	= $http->getDataGet("id");
        //je recupère l'id du user
        $id_user = $_SESSION["auth"]["id"];
        //je verifie si il existe bien en bdd
        $cx = new Connexion();
        $managerU = new ManagerUser($cx);
        $userExp = $managerU->oneUserById($id_user);
        $id_userExp =$userExp->getIdUser(); 
        $mailExp = $userExp->getEmailUser();
        //je verifie si cet id de tribu existe dans ta table amis
        $managerAmis = new ManagerAmis($cx);
        $amis = $managerAmis->oneAmisByIdTribu($id_tribu);


        if(!is_null($amis)){
            //si elle existe demander une annulation si actif_amis est a zero
            $actif = $amis->getActifAmis();
            // var_dump($actif);die();
            if($actif == 0){
                header("Location: annuler-demande-".$id_tribu."");
            }else{
                $flash->setFlash("Désolé un parent est déjà associé à cette tribu, il ne peut pas être remplacé");
            }            
        }else{
            $form 	= new FormAssociation();
            $build 	= $form->buildForm();

            if(($form->isSubmit("go"))&&($form->isValid())){
                $emailDest = $http->getDataPost("email_user");
                $new_user = new User([
                    "email_user" 	=> $emailDest
                ]);
                //je regarde si un user existe avec ce mail
                //si c'est null ( pas de user avec ce mail )
                if(is_null($managerU->userExist($new_user->getEmailUser()))){ 
                    //  crée cet user
                    //je recupère son id
                    $id_userDest = $managerU->insertEmailUserInvitation($emailDest);

                }else{
                    $user = $managerU->userExist($new_user->getEmailUser());
                    $id_userDest = $user->getIdUser();
                }
         
            
                // je crée une demande amis
    			$token 			= time().rand(1000000,9000000);
    			$date 			= new DateTime();
                $date->setTimestamp(strtotime("+6 month")); 
                $validity_token = $date->format("Y-m-d H:i:s");
                
                // $id_userDest = $userDest->getIdUser();

                $new_amis = new Amis([
                    'user_id_expediteur'    => $id_userExp,
                    'user_id_destinataire'  => $id_userDest, 
                    'tribu_id_tribu'        => $id_tribu,
                    'token_tribu'            => $token,
                    'validity_token_tribu'   => $validity_token
                ]);
                // $id_amis = $managerAmis->insertAmis($new_amis);
                // var_dump($new_amis);die();

                $nom = $userExp->getNomUser();
                $prenom = $userExp->getPrenomUser();
                if($managerAmis->insertAmis($new_amis) > 0){
                    // j'envoie un mail avec un lien pour association avec l'AutoMailer
					$automailer = new AutoMailer(
						$emailDest,
						"Invitation pour une association de tribu",
						"
						<h1>Invitation pour une association de tribu</h1>
						<p>
                            <img src=\"http://picmento.fr/templates/fron/????\" 
                            alt=\"Logo picmento\">
						</p>
						<p>".$prenom.$nom." vous invite à être le 2eme parent pour sa tribu.</p>
						<p>Pour voir l'invitation, veuillez cliquer sur ce lien : </p>
						<p>
                            <a 
                            href=\"http://picmento.fr/acceptation-tribu-".$token."\" 
                            title=\"Acceptation invitation\">
                            Ouvrir l'invitation
                            </a>
						</p>
						"
					);

                    
                    
                    
                    $flash->setFlash("Votre demande à bien été envoyé !");
                }
                
                header("Location: afficher-tribu");



            }


        // il va recevoir el lien clicer sur le mail et un autre controller prend le relait ne pas oublier de dire que c'est trop lent si il y a mi 6 mois lol


		return $build;

        }
    }

}
