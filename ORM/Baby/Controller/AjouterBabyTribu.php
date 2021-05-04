<?php
namespace ORM\Baby\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use ORM\Tribu\Model\ManagerTribu;
use ORM\Baby\Entity\Baby;
use ORM\Baby\Model\ManagerBaby;
use Vendors\FormBuilded\FormBabyTribu;

use Vendors\Flash\Flash;
use Vendors\File\Uploader;


class AjouterBabyTribu extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Ajouter un enfant à la tribu");
		$this->setView("ORM/Baby/View/form-baby-tribu.php");
		
		$http = new HTTPRequest();
		$id = $http->getDataGet("id");
		
		$cx			= new Connexion();
		$manager	= new ManagerTribu($cx);
        // je recupère la tribu par son id
		$tribu 		= $manager->oneTribuById($id);
		if(!is_null($tribu)){
            $parent1 = $tribu->getUserIdParent1();
            $parent2 = $tribu->getUserIdParent2();
            if($parent1 == $_SESSION["auth"]["id"]||$parent2 == $_SESSION["auth"]["id"]){

                $form 		= new FormBabyTribu();
                $build 		= $form->buildForm();
                $id_tribu = $tribu->getIdTribu();
                
                if(($form->isSubmit("addbaby"))&&($form->isValid())){
                    $flash = new Flash();
                    
                    //upload de fichier
                    $file 		= $http->getDataFiles("photo_baby");
                    $destination = "medias/photo-baby/";
                    $uploader = new Uploader($file,$destination);
                    $nom_file = $uploader->upload();
                    if(!is_null($nom_file)){
                        //Avec redimensionnement si nécessaire
                        $uploader->imageSizing(500);
                        
                    }
                    $new_baby = new Baby([
                        "nom_baby" 	=> $http->getDataPost("nom_baby"),
                        "photo_baby" => $nom_file,
                        "date_naissance_baby" 	=> $http->getDataPost("date_naissance_baby"),
                        "heure_naissance_baby" => $http->getDataPost("heure_naissance_baby"),
                        "lieu_naissance_baby" => $http->getDataPost("lieu_naissance_baby"),
                        "poids_naissance_baby" 	=> $http->getDataPost("poids_naissance_baby"),
                        "taille_naissance_baby" 	=> $http->getDataPost("taille_naissance_baby"),
                        "tribu_id_tribu"		=> $id_tribu
                        ]);
            
                    $manager	= new ManagerBaby($cx);
                        if($manager->insertNewBaby($new_baby)){
                            
                            $flash->setFlash("Votre enfant a bien été ajouté à la tribu !");
                            header("location: afficher-tribu");
                            exit();
                        }else{
                            $flash->setFlash("Impossible d'ajouter un enfant à la tribu veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
                            header("location: afficher-tribu");
                            exit();
                        }
        
                        
                }
                $cx->close();
                return $build;


            }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }	


        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }	
    }
}


		


