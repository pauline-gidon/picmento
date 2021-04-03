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
		$id = $http->getDataGet("id");
		
		$cx			= new Connexion();
		$managerT	= new ManagerTribu($cx);
        $tribu = $managerT->oneTribuById($id);
        $id_tribu = $tribu->getIdTribu();

        $managerB = new ManagerBaby($cx);
        $babys = $managerB->tribuHasBaby($id_tribu);

        if(!is_null($babys)){
            foreach ($babys as $baby){
                $id_baby[]= $baby->getIdBaby();
            }

        }else{
            $flash->setFlash("Pour ajouter un souvenir votre tribu doit être composée d'au moins un enfant");
			header("Location: afficher-tribu");
        }

        // var_dump($id_baby);die();
        $general[] = $tribu;

		$form 		= new FormSouvenir();
		$build 		= $form->buildForm();

		$general[]= $build;

		if(($form->isSubmit("souvenir"))&&($form->isValid())){
			
            $new_souvenir = new Article([
                "titre_article" 	=> $http->getDataPost("titre_article"),
                "description_article" 	=> $http->getDataPost("description_article"),
                "date_article" 	=> $http->getDataPost("date_article"),
                "actif_article" 	=> $http->getDataPost("actif_article")
            ]);
            // var_dump($new_souvenir);die();
    
            $managerA = new ManagerArticle($cx);
            
            
            $new_id_article = $managerA->insertArticle($new_souvenir);

            foreach($id_baby as $id_baby){
                $managerA->insertArticleHasbaby($id_baby,$new_id_article);
            }


            $managerM = new ManagerMedias($cx);


			//1er photo
			$file		= $http->getDataFiles("photo1");
			// var_dump($file);die();
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

            //2eme photo
            $file2		= $http->getDataFiles("photo2");
			// var_dump($file);die();
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

            //3eme photo
            $file3		= $http->getDataFiles("photo3");
			// var_dump($file);die();
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
                $managerM->insertMediasHasArticle($new_id_article,$new_id_medias3);
			}

            



               
			// var_dump($new_id_article);
			// var_dump($id); die();

			if($managerA->insertArticleHasbaby($id,$new_id_article)){
				
				$flash->setFlash("Votre souvenir a bien été ajouté à la tribu !");
			}else{
				$flash->setFlash("Impossible d'ajouter un souvenir à la tribu, essayez à nouveau ou contactez l'équipe picmento");
			}
			header("Location: afficher-tribu");

				
		}

	

		return $general;

		}
	}


		


