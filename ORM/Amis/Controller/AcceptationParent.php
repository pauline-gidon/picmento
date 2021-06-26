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


class AcceptationParent extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Une demande pour vous");
		$this->setView("ORM/Amis/View/form-demande-parent.php");
        // if(isset($_SESSION["auth"])){
        //     session_destroy();
        // }
        $flash 			= new Flash();
		$http 	= new HTTPRequest();
        $cx = new Connexion();
        //je recupère le token du lien envoyer par mail 
		$token 	= $http->getDataGet("id");
        $_SESSION["token"] = $token;
        $managerAmis   = new ManagerAmis($cx);
        $managerUser = new ManagerUser($cx);
        
        //je recupère la demande amis grace au token et verifie 
        //si la demande est tjr valide et actif amis a == NULL => il ne sont pas amis
        $amis = $managerAmis->oneAmisByToken($token);
        
        if(!is_null($amis)) {
            $valid = $amis->getValidityTokenTribu();
            $actif = $amis->getActifAmis();
            $now = new DateTime('NOW');
            
            if((($valid >= $now) && $actif == 1 )||($valid <= $now && $actif == NULL)||($valid <= $now && $actif == 1)){
              
                //si la demande est plus valide mais actif == 1 il sont amis => faut faire evoluer leur relation.
                // je verifie si il y a bien un id de tribu renseigner dans la demande
                if(!is_null($amis->getTribuIdTribu())){
                    $id_exp = $amis->getUserIdExpediteur();
                    $id_dest = $amis->getUserIdDestinataire();
            
                    // je fait une requete pour avoir son profil utilisateur pour de l'affichage dynamique et savoir si son compt est actif
                    
                    $user_exp = $managerUser->oneUserById($id_exp);
                    $general [] = $user_exp;
        
                    $form 		= new FormDemande();
                    $build 		= $form->buildForm();
                    $general [] = $build;

                    if(($form->isSubmit("go")) && ($form->isValid())) {
                        $demande = $http->getDataPost("demande");
                        if($demande == 1 && $actif == 1){
                            // si il sont amis quand la personne répond oui 
                            $managerT = new ManagerTribu($cx);
                            // je fais un update de ta table tribu avec le user parent 2
                            $managerT->updateTribuUser2($amis);
                            $user_dest = $managerUser->oneUserById($id_dest);

                            $automailer = new AutoMailer(
                                $user_exp->getEmailUser(),
                                "".$user_dest->getEmailUser()." a accepté votre invitation",
                                "
                                <h1>Acceptation de la demande</h1>
                                <p>".$user_dest->getEmailUser()." a accepté votre demande.</p>
                                "
                                 );
                                 if($automailer->sendMail()){
                                    $flash->setFlash("Votre réponse a été renvoyée !");
                                    header("location: index.php");
                                    exit;
                
                                    }



                        }elseif($demande == 1 && $actif == NULL){
                            // si il sont pas amis 
                            // que l'utilisateur repond oui 
                            //je fait un update de la table amis en passant actif a 1 et acceptation a 1

                            $amis->setAcceptationAmis($demande);
                            $amis->setActifAmis(1);
                            $managerAmis->updateAmisByToken($amis);

                            $managerT = new ManagerTribu($cx);
                            // je fais un update de ta table tribu avec le user parent 2
                            $managerT->updateTribuUser2($amis);
                            //j'ajoute leur relation amis dans userhasuser
                            $managerUser->insertUserHasUser($id_exp, $id_dest);
                            
                            //je verifie si le user destinataire de la demande d'amis a un compt user rempli ( je verifie si je champ nom est NULL)
                            //si il est null je le renvoie vers le formulaire d'inscription
                            $user_dest = $managerUser->oneUserById($id_dest);
                            $nom_user = $user_dest->getNomUser();
                                if(is_null($nom_user)){
                                    $flash->setFlash("La demande a bien été validée vous pouvez créer votre compte !");
                                    header("location: inscription");
                                    exit();
                                }else{
                                    $flash->setFlash("La demande a bien été acceptée !");
                                    if(isset($_SESSION["auth"])){
                                        header("location: afficher-tribu");
                                        exit();
                                    }else{
                                        header("location: connexion");
                                        exit();
                                    }
                                    }
                                $automailer = new AutoMailer(
                                    $user_exp->getEmailUser(),
                                    "".$user_dest->getEmailUser()." a accepté votre invitation !",
                                    "
                                    <h1>Acceptation de la demande</h1>
                                    <p>".$user_dest->getEmailUser()." a accepté votre demande.</p>
                                    "
                                     );
                                     if($automailer->sendMail()){
                                        $flash->setFlash("Votre réponse a été renvoyée");
                                        header("location: index.php");
                                        exit;
                    
                                        }
                   
                        }elseif($demande == 0 && $actif == 1){
                            // il refuse l'association mais sont tjr amis
                            //je retire l'id tribu dans la table amis
                            $id = $amis->getIdAmis();
                            $managerAmis->updateAmisNotCooparent($id);
                            //je vais chercher le user en bdd pour avoir son mail
                            $user_dest = $managerUser->oneUserById($id_dest);
        
                             // si la demande est refusé il faut aller prevenir le user exp par mail que sa demande a été refuser
                            $automailer = new AutoMailer(
                            $user_exp->getEmailUser(),
                            "".$user_dest->getEmailUser()." a refusé votre invitation !",
                            "
                            <h1>Ajout d'un deuxième parent</h1>
                            <p>".$user_dest->getEmailUser()." a refusé votre demande.</p>
                            "
                             );
                             if($automailer->sendMail()){
                                $flash->setFlash("Votre réponse a été renvoyée");
                                if(isset($_SESSION["auth"])){
                                    header("location: afficher-tribu");
                                    exit();
                                }else{
                                    header("location: connexion");
                                    exit();
                                }
            
                                }
                         }elseif($demande == 0 && $actif == 0){
                            // il ne sont pas amis je supprme la demande
                            $id = $amis->getIdAmis();
                            $managerAmis->deleteAmisByIdAmis($id);
                            $user_dest = $managerUser->oneUserById($id_dest);
        
                            // si la demande est refusé il faut aller prevenir le user exp par mail que sa demande a été refuser
                           $automailer = new AutoMailer(
                           $user_exp->getEmailUser(),
                           "".$user_dest->getEmailUser()." a refusé votre invitation !",
                           "
                           <h1>Ajout d'un deuxième parent</h1>
                           <p>".$user_dest->getEmailUser()." a refusé votre demande.</p>
                           "
                            );
                            if($automailer->sendMail()){
                               $flash->setFlash("Votre réponse a été renvoyée");
                               if(isset($_SESSION["auth"])){
                                header("location: afficher-tribu");
                                exit();
                            }else{
                                header("location: connexion");
                                exit();
                            }
       
                            }
                         }
                    }
                    $cx->close();
                    return $general;
                }else{
                    $flash->setFlash("Vous avez déjà répondu à la demande.");
                    header("location: index.php");
                    exit();
                }

            }
                   //fermeture du if submit go 
            }else{
                $flash->setFlash("Désolé la demande n'est plus valide.");
                header("location: index.php");
                exit();
                
            }
        }
    }

