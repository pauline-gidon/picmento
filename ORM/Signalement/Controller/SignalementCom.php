<?php
namespace ORM\Signalement\Controller;
use DateTime;
use Vendors\Cryptor;
use OCFram\Connexion;


use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;

use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Signalement\Entity\Signalement;
use Vendors\FormBuilded\FormSignalement;
use ORM\Signalement\Model\ManagerSignalement;

class SignalementCom extends Controller {
	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Signalement");
		$this->setView("ORM/Signalement/View/signalement.php");
        $flash = new Flash();
        $http = new HTTPRequest();
		$id_com_chiffre = $http->getDataGet("id");
        $cryptor = new Cryptor();

        $id_com = $cryptor->decrypt($id_com_chiffre);
		$cx			= new Connexion();
        $managerM = new ManagerCommentaire($cx);
        $com = $managerM->oneCommentaireById($id_com);

        // est-ce qu'il existe ce commentaire en bdd avec cet id
        if(!is_null($com)){
            $general["com"] = $com;
            $form 		= new FormSignalement();
            $build 		= $form->buildForm();
            $general["formulaire"] = $build;
            /// redirection page précedente---------
            if(isset($_SESSION["REF"])){
                $parse = parse_url($_SESSION["REF"]);
                if(($parse['host'] == "picmento.fr") || ($parse['host'] == "localhost")){
                    $url = $_SESSION["REF"]."#com".$com->getIdCommentaire();
                }else {
                    $url = DOMAINE;
                }
            }
            
            ////fin du script redirection

            if(($form->isSubmit("go"))&&($form->isValid())){
                $date 			= new DateTime();
                $date = $date->format("Y-m-d H:i:s");
                $new_signalement = new Signalement([
                    "text_signalement" 	=> $http->getDataPost("text_signalement"),
                    "date_signalement" 	=> $date,
                    "user_id_user" 	=> $_SESSION["auth"]["id"],
                    "commentaire_id_commentaire" => $com->getIdCommentaire()
    
                ]);
                // var_dump($_SERVER['HTTP_REFERER']); die();
                // var_dump($new_signalement); die();
                $managerS = new ManagerSignalement($cx);

                if($managerS->insertNewSignalement($new_signalement) > 0){
                    $flash->setFlash("Votre signalement à bien été envoyé !");
                   
                    

                    header("location: ".$url);
                    exit();

                }else{
                    $flash->setFlash("Impossible d'envoyer le signalement, veuillez réessayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
                }

            }

            if(($form->isSubmit("annuler"))){
                header("location: ".$url);
                exit();
            }




        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }





        $cx->close();
        return $general;
    }
}

		


