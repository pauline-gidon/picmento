<?php
namespace ORM\Tribu\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


use Vendors\Flash\Flash;
// use ORM\Baby\Entity\Baby;
use Vendors\File\Uploader;
use ORM\Medias\Entity\Medias;

use ORM\Article\Entity\Article;
use ORM\Baby\Model\ManagerBaby;
use ORM\Tribu\Model\ManagerTribu;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use Vendors\FormBuilded\FormSouvenir;
// use Vendors\FormBuilded\FormTribu;

class AjouterSouvenirTribu extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Ajouter un souvenir à la tribu");
		$this->setView("ORM/Tribu/View/form-souvenir-tribu.php");

        $flash = new Flash();
		
		$http = new HTTPRequest();
		$id_tribu = $http->getDataGet("id");
		
		$cx			= new Connexion();
		$managerT	= new ManagerTribu($cx);
        //je recupère la tribu par son id
        $tribu = $managerT->oneTribuById($id_tribu);
        //je verifie si c'est bien l'un des deux parent qui ajoute le souvenir à la tribu
        $parent1 = $tribu->getUserIdParent1();
        $parent2 = $tribu->getUserIdParent2();
        if($parent1 == $_SESSION["auth"]["id"]||$parent2 == $_SESSION["auth"]["id"]){

            $managerB = new ManagerBaby($cx);
            // je vais chercher tous les babys de la tribu
            $babys = $managerB->tribuHasBaby($id_tribu);
    
            if(!is_null($babys)){
                foreach ($babys as $baby){
                    $id_babys[]= $baby->getIdBaby();
                }
    
           
    
            // je met la tribu dans un tableau general pour la personalisation du formulaire
            $general[] = $tribu;
    
            $form 		= new FormSouvenir('post',$_FILES);
            $build 		= $form->buildForm();
            
            $general[]= $build;
            if(($form->isSubmit("souvenir"))&&($form->isValid())){
                
                $new_souvenir = new Article([
                    "titre_article" 	=> $http->getDataPost("titre_article"),
                    "description_article" 	=> $http->getDataPost("description_article"),
                    "date_article" 	=> $http->getDataPost("date_article"),
                    "actif_article" 	=> $http->getDataPost("actif_article")
                ]);
        
                $managerA = new ManagerArticle($cx);
                $new_id_article = $managerA->insertArticle($new_souvenir);
                $managerM = new ManagerMedias($cx);
                //*********************************************************1er photo
                $file		= $http->getDataFiles("photo1");
                $destination = "medias/souvenir/";
                $uploader = new Uploader($file,$destination);
                $nom_file = $uploader->upload();
                
                if(!is_null($nom_file)){
                    //Avec redimensionnement si nécessaire
                    $uploader->imageSizing(400);
                    $new_medias = new Medias([
                        "nom_medias" 	=> $nom_file
                        ]);
                    $new_id_medias = $managerM->insertMedias($new_medias);
                    $managerM->insertMediasHasArticle($new_id_article,$new_id_medias);
                }
    
                //*****************************************************2eme photo
                $file2		= $http->getDataFiles("photo2");
                $destination = "medias/souvenir/";
                $uploader = new Uploader($file2,$destination);
                $nom_file2 = $uploader->upload();
                
                if(!is_null($nom_file2)){
                    //Avec redimensionnement si nécessaire
                    $uploader->imageSizing(400);
                    $new_medias2 = new Medias([
                        "nom_medias" 	=> $nom_file2
                        ]);
                        $new_id_medias2 = $managerM->insertMedias($new_medias2);
                        $managerM->insertMediasHasArticle($new_id_article,$new_id_medias2);
                }
    
                //*****************************************************3eme photo
                $file3		= $http->getDataFiles("photo3");
                $destination = "medias/souvenir/";
                $uploader = new Uploader($file3,$destination);
                $nom_file3 = $uploader->upload();
                
                if(!is_null($nom_file3)){
                    //Avec redimensionnement si nécessaire
                    $uploader->imageSizing(400);
                    $new_medias3 = new Medias([
                        "nom_medias" 	=> $nom_file3
                        ]);
                    $new_id_medias3 = $managerM->insertMedias($new_medias3);
                    $new3 = $managerM->insertMediasHasArticle($new_id_article,$new_id_medias3);
                }
                foreach($id_babys as $id_baby){
                    $insertion= $managerA->insertArticleHasbaby($id_baby,$new_id_article);
    
                   if($insertion){
                    
                        $flash->setFlash("Votre souvenir a bien été ajouté à la tribu !");
                    }else{
                        $flash->setFlash("Impossible d'ajouter un souvenir à la tribu. Veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
                    }
                    header("location: afficher-tribu");
                    exit();
    
                }
            }
            $cx->close();
            return $general;
    
            }else{
                $flash->setFlash("Pour ajouter un souvenir votre tribu doit être composée d'au moins un enfant !");
                header("location: afficher-tribu");
                exit();

            }
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }	
    }
}


		


