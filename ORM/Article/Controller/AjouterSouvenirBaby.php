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

class AjouterSouvenirBaby extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Ajouter un souvenir à");
		$this->setView("ORM/Article/View/afficher-form.php");
        $flash = new Flash();

        $http = new HTTPRequest();
		$id_baby = $http->getDataGet("id");
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        $id_user = $_SESSION["auth"]["id"];
      
        if($managerU->verifUserBaby($id_baby, $id_user)){


            $manager	= new ManagerBaby($cx);
            $baby 		= $manager->oneBabyById($id_baby);
            if(!is_null($baby)){

                $nom_baby = $baby->getNomBaby();
                $general[] = $baby;
                $_SESSION["idBaby"] = $baby->getIdBaby();
                // $nom_baby = $baby->getNomBaby();
                
                
                
                $form 		= new FormSouvenir();
                $build 		= $form->buildForm();
                $general [] = $build;
                if((($form->isSubmit("souvenir"))&&($form->isValid())) || (($form->isSubmit("addPhoto"))&&($form->isValid()))){
  


                    $new_souvenir = new Article([
                        "titre_article" 	=> ucfirst($http->getDataPost("titre_article")),
                        "description_article" 	=> ucfirst($http->getDataPost("description_article",1)),
                        "date_article" 	=> $http->getDataPost("date_article"),
                        "actif_article" 	=> $http->getDataPost("actif_article"),
                        "validation_article" => 1
        
                    ]);
            
                    $manager = new ManagerArticle($cx);
                    
                    $new_id_article = $manager->insertArticle($new_souvenir);

                    // $managerM = new ManagerMedias($cx);
        
                    if($manager->insertArticleHasbaby($id_baby,$new_id_article)){

                        if(($form->isSubmit("addPhoto")) && ($form->isValid())){
                            $flash->setFlash("Votre souvenir a bien été créé. Ajouter vos photos !");
                            $_SESSION["newIdSouvenir"] = $new_id_article;
                            header("location: ajouter-photos-souvenir-".$new_id_article."");
                            exit();
                        }
                        $flash->setFlash("Votre souvenir a bien été créé !");
                        header("location: afficher-souvenirs-".$id_baby."");
                        exit();
                    }else{
                        $flash->setFlash("Impossible d'ajouter un souvenir à ".$nom_baby." veuillez réessayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span>");
                    }                   
                }
            }
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
        $cx->close();
        return $general;
    }
}

		


