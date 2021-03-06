<?php
namespace ORM\Article\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;


use Vendors\Flash\Flash;
use Vendors\File\Uploader;
// use ORM\Article\Entity\Article;
use ORM\Medias\Entity\Medias;
// use ORM\Baby\Model\ManagerBaby;

use ORM\User\Model\ManagerUser;
use Vendors\FormBuilded\FormPhoto;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;

class AjouterPhoto extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Ajouter une photo");
		$this->setView("ORM/Article/View/afficher-form-simple.php");
		
        $http = new HTTPRequest();
		$id = $http->getDataGet("id");
		
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        //je verifie si l'utilisateur a les doit sur cet article
        if($managerU->verifUserArticle($id)){

            $manager = new ManagerArticle($cx);
            //je recupère l'article par son id
            $article = $manager->oneArticleById($id);
            if(!is_null($article)){
            $id_article = $article->getIdArticle();
            

            if($manager->articleCountMedias($id_article)){

                $form 		= new FormPhoto();
                $build 		= $form->buildForm();
                if(($form->isSubmit("addPhoto"))&&($form->isValid())){
                    $flash = new Flash();
                    
                    $file		= $http->getDataFiles("photo");
                    $destination = "medias/souvenir/";
                    $uploader = new Uploader($file,$destination);
                    $nom_file = $uploader->upload();
                    
                    if(!is_null($nom_file)){
                        //Avec redimensionnement si nécessaire
                        $uploader->imageSizing(700);
                        $new_medias = new Medias([
                            "nom_medias" 	=> $nom_file
                            ]);
                            $manager1 = new ManagerMedias($cx);
                            //insertion du medias
                            $new_id_medias = $manager1->insertMedias($new_medias);
                            //insertion d'une relation medias articles
                            $manager1->insertMediasHasArticle($id_article,$new_id_medias);
                            $flash->setFlash("Votre photo a bien été ajoutée !");
                            header("location: afficher-souvenirs-".$_SESSION["idBaby"]."#ancre-".$id_article."");
                            exit();

                        }
                    }
                    $cx->close();
                    return $build;
                    
                    }else{
                        $flash = new Flash();
                        $flash->setFlash("Votre souvenir a atteint le nombre maximal de photos. Pour ajouter cette photo, veuillez modifier ou supprimer une autre photo !");
                        header("location: afficher-souvenirs-".$_SESSION["idBaby"]."#ancre-".$id_article."");
                        exit();
                    }
                }
            }else{
                header("location: ".DOMAINE."errors/404.php");
                exit();
            }
        }
    }
