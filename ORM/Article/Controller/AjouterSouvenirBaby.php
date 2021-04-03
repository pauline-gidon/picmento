<?php
namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;


use ORM\Article\Model\ManagerArticle;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Entity\Article;
use ORM\Medias\Entity\Medias;
use ORM\Baby\Model\ManagerBaby;

use Vendors\Flash\Flash;
use Vendors\File\Uploader;
use Vendors\FormBuilded\FormSouvenir;

class AjouterSouvenirBaby extends Controller {

	function getResult() {
        $http = new HTTPRequest();
		$id = $http->getDataGet("id");
		
		$cx			= new Connexion();
		$manager	= new ManagerBaby($cx);
		$baby 		= $manager->oneBabyById($id);
        $nom_baby = $baby->getNomBaby();
        $general[] = $baby;
		// $nom_baby = $baby->getNomBaby();
		$this->setLayout("back");
		$this->setTitle("Ajouter un souvenir");
		$this->setView("ORM/Article/View/afficher-form.php");
		
		
		
		$form 		= new FormSouvenir();
		$build 		= $form->buildForm();
		$general [] = $build;
		if(($form->isSubmit("souvenir"))&&($form->isValid())){
            $flash = new Flash();
			
            $new_souvenir = new Article([
                "titre_article" 	=> $http->getDataPost("titre_article"),
                "description_article" 	=> $http->getDataPost("description_article",1),
                "date_article" 	=> $http->getDataPost("date_article"),
                "actif_article" 	=> $http->getDataPost("actif_article")
            ]);
            // var_dump($new_souvenir);die();
    
            $manager = new ManagerArticle($cx);
            
            
            $new_id_article = $manager->insertArticle($new_souvenir);

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

			if($manager->insertArticleHasbaby($id,$new_id_article)){
				
				$flash->setFlash("Votre souvenir a bien été ajouté !");
			}else{
				$flash->setFlash("Impossible d'ajouter un souvenir à ".$nom_baby." veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
			}
			header("Location: afficher-souvenirs-".$id."");

				
		}
	

		return $general;

		}
	}


		


