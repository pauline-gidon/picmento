<?php
namespace ORM\Article\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use ORM\Medias\Entity\Medias;
use ORM\Article\Entity\Article;
use ORM\Baby\Model\ManagerBaby;

use ORM\User\Model\ManagerUser;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use Vendors\FormBuilded\FormSouvenir;
use Vendors\FormBuilded\FormPhotosSouvenir;

class AjouterPhotosSouvenir extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Ajouter des photos");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
        $flash = new Flash();
        $http = new HTTPRequest();
		$cx			= new Connexion();
        //get id_article
		$id = $http->getDataGet("id");
        $managerU = new ManagerUser($cx);
        // je verfiie si l'article est le meme crée dans la page précédente avec le nouvel id article
        if(isset($_SESSION["newIdSouvenir"]) && $_SESSION["newIdSouvenir"] == $id){
            
            //je verifie si le user connecter est bien l'un des deux parents
            if($managerU->verifUserArticle($id)){
                
                $manager = new ManagerArticle($cx);
                //je recupère l'article par son id
                $article = $manager->oneArticleById($id);
                if(!is_null($article)){
                    //je recupère l'id article
                    $id_article = $article->getIdArticle();
                    // je definie la destination d'upload
                    $destination = "medias/souvenir/";
                    $error = 0;
    
                    // si un File1 a été envoyé et pas vide
                    if(isset($_FILES["photo1"]) && $_FILES["photo1"]["error"] == 0){
                        // je recupère les donnée
                        $file1 		= $http->getDataFiles("photo1");
                        
                        //On fait un tableau contenant les extensions autorisées.
                        //Comme il s'agit d'un avatar pour l'exemple, on ne prend que des extensions d'images.
                        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                        // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                        $extension = strrchr($file1["name"], '.');
                        //Ensuite on teste
                        $taille_maxi = 512000000;
                        //Taille du fichier
                        $taille = filesize($file1['tmp_name']);
                        
                        if($taille < $taille_maxi && in_array($extension, $extensions)){
                            
                            $uploader = new Uploader($file1,$destination);
                            $nom_file1 = $uploader->upload();
                            
                            $_SESSION["nom_photo1"] = $nom_file1;
                            
                            if(!is_null($nom_file1)){
                                $uploader->imageSizing(700);
                            }
                            
                            
                        }else {
                            
                            $flash->setFlash("Upload impossible sur une ou plusieurs photos (les extensions de fichiers autorisés sont [.png, .gif, .jpg, .jpeg ] et le fichier doit être inférieur a 512 Mo !)");
                            $error = 1;
                            
                        }                      
                    }
                    
                    
                    if(isset($_FILES["photo2"]) && $_FILES["photo2"]["error"] == 0){
                        
                        $file2 		= $http->getDataFiles("photo2");
                        
                        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                        // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                        $extension = strrchr($file2["name"], '.');
                        //Ensuite on teste
                        $taille_maxi = 512000000;
                        //Taille du fichier
                        $taille = filesize($file2['tmp_name']);
                        
                        if($taille < $taille_maxi && in_array($extension, $extensions)){
                            
                            $uploader = new Uploader($file2,$destination);
                            $nom_file2 = $uploader->upload();
                            
                            $_SESSION["nom_photo2"] = $nom_file2;
                            
                            if(!is_null($nom_file2)){
                                $uploader->imageSizing(700);
                            }
                            
                            
                        }else {
                            
                            $flash->setFlash("Upload impossible sur une ou plusieurs photos (les extensions de fichiers autorisés sont [.png, .gif, .jpg, .jpeg ] et le fichier doit être inférieur a 512 Mo !)");
                            $error = 1;
                        }                      
                        
                    }
                    
    
                    if(isset($_FILES["photo3"]) && $_FILES["photo3"]["error"] == 0){
                        
                        $file3 		= $http->getDataFiles("photo3");
                        
                        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                        // récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
                        $extension = strrchr($file3["name"], '.');
                        //Ensuite on teste
                        $taille_maxi = 512000000;
                        //Taille du fichier
                        $taille = filesize($file3['tmp_name']);
                        
                        if($taille < $taille_maxi && in_array($extension, $extensions)){
                            
                            $uploader = new Uploader($file3,$destination);
                            $nom_file3 = $uploader->upload();
                            
                            $_SESSION["nom_photo3"] = $nom_file3;
                            
                            if(!is_null($nom_file3)){
                                $uploader->imageSizing(700);
                            }
                            
                            
                        }else {
                            
                            $flash->setFlash("Upload impossible sur une ou plusieurs photos (les extensions de fichiers autorisés sont [.png, .gif, .jpg, .jpeg ] et le fichier doit être inférieur a 512 Mo !)");
                            $error = 1;
                        }                     
                    }
                    if($error != 0){
    
                        header("location: tribu-ajouter-photos-souvenir-".$id);
                        exit();
                    }
                    $form 		= new FormPhotosSouvenir();
                    $build 		= $form->buildForm();
                    
                    
                    
                    if(($form->isSubmit("go"))&&($form->isValid())){
                        
                        $manager1 = new ManagerMedias($cx);
                        
                            
                            if(isset($_SESSION["nom_photo1"])){
                                $new_medias1 = new Medias([
                                    "nom_medias" 	=> $_SESSION["nom_photo1"]
                                ]);
                                //insertion d'un media dans la table medias
                                $new_id_medias1 = $manager1->insertMedias($new_medias1);
                                //insetion relation media article dans la table associative
                                $photoUpload1 = $manager1->insertMediasHasArticle($id_article,$new_id_medias1);
                                unset($_SESSION["nom_photo1"]);
                               
                            }
                            if(isset($_SESSION["nom_photo2"])){
                                $new_medias2 = new Medias([
                                    "nom_medias" 	=> $_SESSION["nom_photo2"]
                                ]);
                                //insertion d'un media dans la table medias
                                $new_id_medias2 = $manager1->insertMedias($new_medias2);
                                //insetion relation media article dans la table associative
                                $photoUpload2 = $manager1->insertMediasHasArticle($id_article,$new_id_medias2);
                                unset($_SESSION["nom_photo2"]);
                                
                            }
                            if(isset($_SESSION["nom_photo3"])){
                                $new_medias3 = new Medias([
                                    "nom_medias" 	=> $_SESSION["nom_photo3"]
                                ]);
                                //insertion d'un media dans la table medias
                                $new_id_medias3 = $manager1->insertMedias($new_medias3);
                                //insetion relation media article dans la table associative
                                $photoUpload3 = $manager1->insertMediasHasArticle($id_article,$new_id_medias3);
                                unset($_SESSION["nom_photo3"]);
                                
                            }
    
                            if((isset($photoUpload1) && $photoUpload1 == true) || (isset($photoUpload2) && $photoUpload2 == true) || (isset($photoUpload3) && $photoUpload3 == true)){
                                $flash->setFlash("Photo(s) enregistée(s) !");
                                unset($_SESSION["newIdSouvenir"]);
                                header("location: afficher-souvenirs-".$_SESSION["idBaby"]."#ancre-".$id_article.""); 
                                unset($_SESSION["idBaby"]);
    
                                exit();
                            }else{
                                unset($_SESSION["newIdSouvenir"]);
                                $flash->setFlash("Vous n’avez pas enregistré de photo !");
                                header("location: afficher-souvenirs-".$_SESSION["idBaby"]."#ancre-".$id_article.""); 
                                unset($_SESSION["idBaby"]);
    
                                exit();
    
                            }
                        }
                        $cx->close();
                        return $build;
    
    
            } //if !is_null($article))
    
            }else{ // if parent ok
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
        }else{ // id article correspond pas a la variable de session 
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}