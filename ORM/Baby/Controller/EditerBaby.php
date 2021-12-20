<?php
namespace ORM\Baby\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


// use ORM\Tribu\Model\ManagerTribu;
// use ORM\Baby\Entity\Baby;
use Vendors\Flash\Flash;
use ORM\Baby\Model\ManagerBaby;

use ORM\User\Model\ManagerUser;
use Vendors\FormBuilded\FormBaby;
// use Vendors\File\Uploader;


class EditerBaby extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Modifier le profil");
		$this->setView("ORM/Baby/View/form-baby-tribu.php");
		
		$http = new HTTPRequest();
		$id_baby = $http->getDataGet("id");
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        $id_user = $_SESSION["auth"]["id"];

        if($managerU->verifUserBaby($id_baby, $id_user)){

            $manager	= new ManagerBaby($cx);
            $baby 		= $manager->oneBabyById($id_baby);
            $heure = $baby->getHeureNaissanceBaby();
            $heure = substr($heure,0,5);
            $baby->setHeureNaissanceBaby($heure);
            $nom_baby = $baby->getNomBaby();
            if(!is_null($baby)){

                $form 		= new FormBaby("post",$baby);
                $build 		= $form->buildForm();
                
                if(($form->isSubmit("addbaby"))&&($form->isValid())){
                    $flash = new Flash();
                    
                    //j'ajouter les 3 zero si c'est un poids rond
                    $poids = $http->getDataPost("poids_naissance_baby");
                    if(strlen($poids) == 1){
                        $poids = sprintf('%0.3f', $poids);
                    }
                    //j'ajouter les seonde a l'heur saisie
                    $heur_naissance = $http->getDataPost("heure_naissance_baby");
                    $heur_naissance = $heur_naissance.":00";

                    $baby->setNomBaby(ucfirst($http->getDataPost("nom_baby")));
                    $baby->setDateNaissanceBaby($http->getDataPost("date_naissance_baby"));
                    $baby->setHeureNaissanceBaby($heur_naissance);
                    $baby->setLieuNaissanceBaby(ucfirst($http->getDataPost("lieu_naissance_baby")));
                    $baby->setPoidsNaissanceBaby($poids);
                    $baby->setTailleNaissanceBaby($http->getDataPost("taille_naissance_baby"));
                        if($manager->updateProfilBaby($baby)){
                            
                            $flash->setFlash("Le profil de ".$baby->getNomBaby()." a bien été modifié !");
                            header("location: afficher-tribu");
                            exit();
                        }else{
                            $flash->setFlash("Vous n'avez pas fait de modification !");
                            header("location: afficher-tribu");
                            exit();
                        }                       
                }
                
            }
            
            
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
        
    $cx->close();
    return $build;
    }
}


		


