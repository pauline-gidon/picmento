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
        $flash = new Flash();
        // je recupère la tribu par son id
		$tribu 		= $manager->oneTribuById($id);
		if(!is_null($tribu)){
            $parent1 = $tribu->getUserIdParent1();
            $parent2 = $tribu->getUserIdParent2();

            if($parent1 == $_SESSION["auth"]["id"]||$parent2 == $_SESSION["auth"]["id"]){

                $form 		= new FormBabyTribu('post');
                $build 		= $form->buildForm();
                $id_tribu = $tribu->getIdTribu();


                

                if(($form->isSubmit("addbaby"))&&($form->isValid())){
                    
                    //upload de fichier
                    // $nomOrigine = $_FILES['photo_baby']['name'];
                    // $elementsChemin = pathinfo($nomOrigine);
                    // $extensionFichier = $elementsChemin['extension'];
                    // $extensionsAutorisees = array("jpeg", "jpg", "png");
                    // if (!(in_array($extensionFichier, $extensionsAutorisees))) {
                    //     $flash->setFlash("Le fichier n'a pas une extension autorisée");
                    //     header("location: ajouter-baby-tribu-".$id."");
                    //     die();
                    // }
                    //if(isset($_SESSION))
                    // if (is_uploaded_file($_SESSION['photo_baby']['tmp_name']) ) {
                        
                    //     $destination = "medias/photo-baby/";

                    //     if(!isset($_SESSION["photo"])){
                    //         $_SESSION["photo"] = $_FILES["photo_baby"];
                    //         $file 		= $http->getDataFiles("photo_baby");
                    //     }else{
                    //         $_SESSION["photo"] = $_FILES["photo_baby"];
                    //         $file 		= $_SESSION["photo"];
                    //         // $uploader = new Uploader($file,$destination);
                    //         // $nom_file = $uploader->upload();
                    //     }
                    //     $uploader = new Uploader($file,$destination);
                    //     $nom_file = $uploader->upload();
                    // }
                    // llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll
                        
                    $file 		= $http->getDataFiles("photo_baby");    
                    // var_dump($file); die();

                        $destination = "medias/photo-baby/";
                        // if(isset($_FILES["photo_baby"])){
                            // }
                            
                            if(empty($file)){
                                
                                if(isset($_SESSION["photo"]) && !empty($_SESSION["photo"])){
                                        $file = $_SESSION["photo"];
                                        $uploader = new Uploader($file,$destination);
                                        $nom_file = $uploader->upload();
                                    }

                            }else{
                            }
                            $uploader = new Uploader($file,$destination);
                            $nom_file = $uploader->upload();
                            
                            
                            
                            
                            
                            if(!is_null($nom_file)){
                                //Avec redimensionnement si nécessaire
                                $uploader->imageSizing(500);
                        
                            }
                            $new_baby = new Baby([
                                "nom_baby" 	=> ucfirst($http->getDataPost("nom_baby")),
                                "photo_baby" => $nom_file,
                                "date_naissance_baby" 	=> $http->getDataPost("date_naissance_baby"),
                                "heure_naissance_baby" => $http->getDataPost("heure_naissance_baby"),
                                "lieu_naissance_baby" => ucfirst($http->getDataPost("lieu_naissance_baby")),
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
                    if(isset($_FILES["photo_baby"])){
                        $_SESSION["photo"] = $_FILES["photo_baby"];

                    }
                    
                    // var_dump($_FILES);
                    // var_dump($_SESSION["photo"]);
                    // var_dump($_POST);
         
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


		


