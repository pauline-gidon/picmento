<?php
namespace ORM\User\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;

use ORM\User\Entity\User;
use ORM\User\Model\ManagerUser;

use Vendors\FormBuilded\FormProfil;
use Vendors\Flash\Flash;

use DateTime;


class ModifierProfil extends Controller {

	function getResult(){
		$this->setLayout("back");
		$this->setTitle("Modifier votre profil");
		$this->setView("ORM/User/View/afficher-form.php");

		$connexion	= new Connexion();
		$manager	= new ManagerUser($connexion);
		$user		= $manager->oneUserById($_SESSION["auth"]["id"]);
		$_SESSION["auth"]["email"] = $user->getEmailUser();
        $email_session = $_SESSION["auth"]["email"];

		$form 	= new FormProfil("post",$user);
		$build 	= $form->buildForm();

		//Si soumission d'un form valide (sans erreur)
		if(($form->isSubmit("go"))&&($form->isValid())){
			$flash	= new Flash();
			$http = new HTTPRequest();

            $email = $http->getDataPost("email_user");
            if($email !== $email_session){
                $verif_user = $manager->userExist($email);
                if(!is_null($verif_user)){
                        $flash->setFlash("Cet email existe déjà !");
                        header("location: modifier-profil");
                        exit();
                }
            }
            
            $verif_pseudo = $http->getDataPost("pseudo_user");
            if(!empty($verif_pseudo)){
                $verif_pseudo = $manager->pseudoExist($verif_pseudo);
                if(!is_null($verif_pseudo)){
                    $flash->setFlash("Ce pseudo existe déjà !");
                    header("location: modifier-profil");
                    exit();
                }
            }

            $user->setNomUser($http->getDataPost("nom_user"));
            $user->setPrenomUser($http->getDataPost("prenom_user"));
            $user->setPseudoUser($http->getDataPost("pseudo_user"));
            $user->setEmailUser($email);
            $user->setPassUser($http->getDataPost("pass_user"));

            if($manager->oneUserByIdAndPass($user)){
                //La modif
                if($manager->updateProfil($user)){
                    $_SESSION["auth"]["statut"] 	= $user->getStatutUser();
                    $_SESSION["auth"]["nom"] 			= $user->getNomUser();
                    $_SESSION["auth"]["prenom"] 	= $user->getPrenomUser();
                    $_SESSION["auth"]["pseudo"] 	= $user->getPseudoUser();
                    
                    $flash->setFlash("Modification ok !");
                

                }else{
                    $flash->setFlash("Vous n'avez pas fait de modification !");
                    
                }
                header("location: espace-perso");
                exit();

            }else{
                //Attention pas le bon mdp
                $flash->setFlash("Mot de passe incorrect");
            }
            


			
			
		}//Fin de la soumission

		$connexion->close();

		return $build;

	}

}

