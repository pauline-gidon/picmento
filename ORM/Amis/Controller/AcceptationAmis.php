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


class AcceptationAmis extends Controller {

	function getResult(){

		$this->setLayout("front");
		$this->setTitle("Une demande pour vous");
		$this->setView("ORM/Amis/View/form-demande-ami.php");
        if(isset($_SESSION["auth"])){
            session_destroy();
        }
        $flash 			= new Flash();
		$http 	= new HTTPRequest();
        $cx = new Connexion();
        //je recupère le token du lien envoyer par mail 
		$token 	= $http->getDataGet("id");
        //je verifie si dans a table amis une demande a se token et si il est encore valide
        $_SESSION["token"] = $token;
        $managerAmis   = new ManagerAmis($cx) ;
        $amis = $managerAmis->oneAmisByToken($token);
        
        
        if(!is_null($amis)) {
            if(is_null($amis->getActifAmis())){

                $now = new DateTime('NOW');
                if($amis->getValidityTokenTribu() <= $now) {
    
                    $id_exp = $amis->getUserIdExpediteur();
                    $id_dest = $amis->getUserIdDestinataire();
            
                    // je fait une requete pour avoir son profil utilisateur pour de l'affichage dynamique et savoir si son compt est actif
                    $managerUser = new ManagerUser($cx);
                    $user_exp = $managerUser->oneUserById($id_exp);
                    $general [] = $user_exp;
        
                    $form 		= new FormDemande();
                    $build 		= $form->buildForm();
                    $general [] = $build;
        
                    
                    if(($form->isSubmit("go")) && ($form->isValid())) {
                        $demande = $http->getDataPost("demande");
                        //je fait un update de la table amis que la reponse soit positive ou negative
                        //si la reponse est positif
                        if($demande == 1){
            
                            $amis->setAcceptationAmis($demande);
                            $amis->setActifAmis(1);
                            $managerAmis->updateAmisByToken($amis);
                            $managerT = new ManagerTribu($cx);
                            //update L'id du user 2 dans la tribu
                            $managerT->updateTribuUser2($amis);
                            // je verifie si les 2 id de la table amis sont deja en relation user_has_user
                            // si se n'est pas le cas
                            //je fais une insertion de relation user_has_user
                                    if($managerUser->oneUserHasUser($id_exp, $id_dest) == false){
                                        $managerUser->insertUserHasUser($id_exp, $id_dest);
                                    }
                            //je verifie si le user destinataire de la demande d'amis a un compt user rempli ( je verifie si je champ nom est NULL)
                            //si il est null je le renvoie vers le formulaire d'inscription
                            $user_dest = $managerUser->oneUserById($id_dest);
                            $nom_user = $user_dest->getNomUser();
                                if(is_null($nom_user)){
                                    $flash->setFlash("La demande a bien été validée vous pouvez crée votre compte !");
                                    header("location: inscription");
                                    exit();
                                }else{
                                    $flash->setFlash("La demande a bien été acceptée vous pouvez vous connecter ! ");
                                    header("location: connexion");
                                    exit();
                                }
                                $automailer = new AutoMailer(
                                    $user_exp->getEmailUser(),
                                    "".$user_dest->getEmailUser()." a accepter votre invitation",
                                    "
                                    <h1>Acceptation de la demande</h1>
                                    <p>".$user_dest->getEmailUser()." a accepter votre demande.</p>
                                    "
                                     );
                   
                        }else{
                            $amis->setAcceptationAmis($demande);
                            $amis->setActifAmis(0);
                            $managerAmis->updateAmisByToken($amis);
                            $user_dest = $managerUser->oneUserById($id_dest);
        
                        // si la demande est refusé il faut aller prevenir le user exp par mail que sa demande a été refuser
                            $automailer = new AutoMailer(
                            $user_exp->getEmailUser(),
                            "".$user_dest->getEmailUser()." a refusé votre invitation",
                            "
                            <h1>Ajout d'un deuxième parent</h1>
                            <p>".$user_dest->getEmailUser()." a refusé votre demande.</p>
                            "
                             );
                            header("location: index.php");
                        
                         }
                        if($automailer->sendMail()){
                            //Allez voir votre mail d'activation
                            $flash->setFlash("Votre réponse a été renvoyé");
        
                            }
                        }
        
                    }else{
                        $flash->setFlash("Désolé la demande à expirée.");
                        
                    }
                    
                    
                    $cx->close();
                    return $general;
                }else{
                    $flash->setFlash("Vous avez déjà repondu à la demande.");
            }
              
                    //fermeture du if submit go 

            }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
                
        }
    }

