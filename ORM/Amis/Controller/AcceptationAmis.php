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
        // if(isset($_SESSION["auth"])){
        //     session_destroy();
        // }
        $flash 			= new Flash();
		$http 	= new HTTPRequest();
        $cx = new Connexion();
        //je recupère le token du lien envoyer par mail 
		$token 	= $http->getDataGet("id");
        $_SESSION["token"] = $token;
        $managerAmis   = new ManagerAmis($cx) ;
        //je verifie si dans la table amis une demande a se token et si il est encore valide
        $amis = $managerAmis->oneAmisByTokenValide($token);
       
     
        // je verifie si le suser sont déja en relation grace a une remande d'association de parent!
        
        if(!is_null($amis)) {
            if(is_null($amis->getActifAmis())){
         
                   
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
                          
                            $managerT = new ManagerTribu($cx);
                            //update de la table amis par le token et udplate de la table tribu sont ok
                            if($managerAmis->updateAmisByToken($amis)){

                            
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
                                $automailer = new AutoMailer(
                                    $user_exp->getEmailUser(),
                                    "".$user_dest->getEmailUser()." a accepté votre invitation",
                                    "
                                    <h1>Acceptation de la demande</h1>
                                    <p>".$user_dest->getEmailUser()." a accepté votre demande.</p>
                                    "
                                     );
                                if($automailer->sendMail()){
                                //Allez voir votre mail d'activation
                                $flash->setFlash("Votre réponse a été renvoyée");
            
                            }
                            if(is_null($nom_user)){
                                $flash->setFlash("La demande a bien été validée vous pouvez créer votre compte !");
                                header("location: inscription");
                                exit();
                            }else{
                                $flash->setFlash("La demande a bien été acceptée ! ");
                                if(isset($_SESSION["auth"])){
                                    header("location: afficher-tribu");
                                    exit();
                                }else{
                                    header("location: connexion");
                                    exit();
                                }
                            }

                            }
                   
                        }else{
                            //je supprime la demande avec un delete

                            $id_amis = $amis->getIdAmis();
                            $managerAmis->deleteAmisByIdAmis($id_amis);
                            $user_dest = $managerUser->oneUserById($id_dest);
        
                        // si la demande est refusé il faut aller prevenir le user exp par mail que sa demande a été refuser
                            $automailer = new AutoMailer(
                            $user_exp->getEmailUser(),
                            "".$user_dest->getEmailUser()." a refusé votre invitation !",
                            "
                            <h1>Ajout d'un deuxième parent</h1>
                            <p>".$user_dest->getEmailUser()." a refusé votre demande .</p>
                            "
                             );
                             if($automailer->sendMail()){
                                //Allez voir votre mail d'activation
                                $flash->setFlash("Votre réponse a été renvoyée");
            
                                }
                            header("location: index.php");
                            exit();
                        
                         }
                        
                        }
        
                   
                    
                    
                    $cx->close();
                    return $general;
                }else{
                    $flash->setFlash("Vous avez déjà répondu à la demande.");
            }
              
                    //fermeture du if submit go 

            }else {
                $flash->setFlash("Désolé la demande a expiré.");
                
        }
    }
}

