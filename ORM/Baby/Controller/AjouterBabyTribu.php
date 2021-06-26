<?php
namespace ORM\Baby\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


use Vendors\Flash\Flash;
use ORM\Baby\Entity\Baby;
use Vendors\File\Uploader;
use Vendors\Nettoyage\Chaine;

use ORM\Baby\Model\ManagerBaby;
use ORM\Tribu\Model\ManagerTribu;
use Vendors\FormBuilded\FormBabyTribu;


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
            // je verifie si c'est bien l'un des deut parent qui ajoute un enfant
            if($parent1 == $_SESSION["auth"]["id"]||$parent2 == $_SESSION["auth"]["id"]){
                
                if(isset($_FILES["photo_baby"]) && $_FILES["photo_baby"]["error"] == 0){
                    
                    $destination = "medias/photo-baby/";
                    $file 		= $http->getDataFiles("photo_baby");
                    
                    //On fait un tableau contenant les extensions autorisées.
                    //Comme il s'agit d'un avatar pour l'exemple, on ne prend que des extensions d'images.
                    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                    // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                    $extension = strrchr($file["name"], '.');
                    //Ensuite on teste
                    $taille_maxi = 512000000;
                    //Taille du fichier
                    $taille = filesize($file['tmp_name']);
                    
                    if($taille < $taille_maxi && in_array($extension, $extensions)){
                        
                        $uploader = new Uploader($file,$destination);
                       
                        $nom_file = $uploader->upload();
                        
                        $_SESSION["nom_photo_baby"] = $nom_file;
                        
                        if(!is_null($nom_file)){
                            $uploader->imageSizing(500);
                            
                        }
                        
                        
                    }else {
                    
                        $flash->setFlash("Upload impossible sur une ou plusieurs photos (les extensions de fichiers autorisés sont [.png, .gif, .jpg, .jpeg ] et le fichier doit être inférieur a 512 Mo !)");
                    }
                    

                }
                $form 		= new FormBabyTribu('post');
                $build 		= $form->buildForm();
                $id_tribu = $tribu->getIdTribu();

                    if(($form->isSubmit("addbaby"))&&($form->isValid())){
          
                    $new_baby = new Baby([
                        "nom_baby" 	=> ucfirst($http->getDataPost("nom_baby")),
                        "photo_baby" => $_SESSION["nom_photo_baby"],
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
                            unset($_SESSION["nom_photo_baby"]);
                            header("location: afficher-tribu");
                            exit();
                        }else{
                            $flash->setFlash("Impossible d'ajouter un enfant à la tribu veuillez réessayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
                            header("location: afficher-tribu");
                            exit();
                        }
                        
                        
                    }
                
                $cx->close();
                return $build;
                    
                    // var_dump($_FILES);
                    // var_dump($_SESSION["photo"]);
                    // var_dump($_POST);
         


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


		


