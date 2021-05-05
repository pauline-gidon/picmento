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

        $http = new HTTPRequest();
		$id = $http->getDataGet("id");
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        $flash = new Flash();
        
        //je verifie si l'utilisateur a les doits sur cet article
        if($managerU->verifUserArticle($id)){

            $manager = new ManagerArticle($cx);
            //je recupère l'article par son id
            $article = $manager->oneArticleById($id);
            if(!is_null($article)){
                $id_article = $article->getIdArticle();
                $titre_article = $article->getTitreArticle();
                $baby = $manager->babyWithArticleById($id);
                $id_baby = $baby->getIdBaby();
                
                if($manager->articleCountMedias($id_article)){
                    $managerM = new ManagerMedias($cx);
                    $form 		= new FormPhotosSouvenir();
                    $build 		= $form->buildForm();
                    $flash = new Flash();
                    if((($form->isSubmit("go")) || ($form->isSubmit("addPhoto")))&&($form->isValid())){
                        $flash = new Flash();
                        
                        $file		= $http->getDataFiles("photo");
                        $destination = "medias/souvenir/";
                        $uploader = new Uploader($file,$destination);
                        $nom_file = $uploader->upload();
                        
                        if(!is_null($nom_file)){
                            //Avec redimensionnement si nécessaire
                            $uploader->imageSizing(400);
                            $new_medias = new Medias([
                                "nom_medias" 	=> $nom_file
                                ]);
                                $manager1 = new ManagerMedias($cx);
                                $new_id_medias = $manager1->insertMedias($new_medias);
                                if($manager1->insertMediasHasArticle($id_article,$new_id_medias)){

                                    if(($form->isSubmit("addPhoto")) && ($form->isValid())){
                                        $flash->setFlash("Votre photo a bien été ajouter !");
                                        header("location: ajouter-photos-souvenir-".$id_article."");
                                        exit();
                                    }
                                    $flash->setFlash("Votre photo a bien été ajouté !");
                                    header("location: afficher-souvenirs-".$_SESSION["idBaby"]."");
                                    exit();
                                };
                               
    
                            }
                        }
                        $cx->close();
                        return $build;
                    
                }else{ //1er compatage medias
                    $flash->setFlash("Votre souvenir \"".$titre_article."\" a atteint le nombre maximal de photos. Pour ajouter cette photo, veuillez modifier ou supprimer une autre photo !");
                    header("location: afficher-souvenirs-".$_SESSION["idBaby"]."");
                    exit();
                }
            } //if !is_null($article))
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
    }
}