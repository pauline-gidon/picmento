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
use ORM\User\Model\ManagerUser;
use ORM\Tribu\Model\ManagerTribu;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use Vendors\FormBuilded\FormSouvenir;
use Vendors\FormBuilded\FormSouvenirTribu;
use Vendors\FormBuilded\FormSouvenirTribuAmis;
// use Vendors\FormBuilded\FormTribu;

class AjouterSouvenirTribuAmis extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Ajouter un souvenir à la tribu");
		$this->setView("ORM/Tribu/View/form-souvenir-tribu.php");

        $flash = new Flash();
		
		$http = new HTTPRequest();
		$id_tribu = $http->getDataGet("id");
		
		$cx			= new Connexion();
        $managerU = new ManagerUser($cx);
        //une variable de session a été crée à, l'affichage des tribu de mon amis avec id ami $_SESSION["ami"]["id"]
        //je verifie si la personne connecter et le profil visité son bien amis
        
        $id_user = $_SESSION["ami"]["id"];
        if($managerU->verifUserAmis($id_user)){
            //Je verifie si cette tribu appartien bien a mon amis
            $managerT = new ManagerTribu($cx);
            $tribu = $managerT->oneTribuByIds($id_tribu, $id_user);
            if(!is_null($tribu)){
            
            $managerB = new ManagerBaby($cx);
                // je vais chercher tous les babys de la tribu
                $babys = $managerB->tribuHasBaby($id_tribu);
        
                if(!is_null($babys)){
                    foreach ($babys as $baby){
                        $id_babys[]= $baby->getIdBaby();
                    }
        
               
        
                // je met la tribu dans un tableau general pour la personalisation du formulaire
                $general[] = $tribu;
        
                $form 		= new FormSouvenirTribuAmis();
                $build 		= $form->buildForm($babys);
                
                $general[]= $build;
                if(($form->isSubmit("souvenir")) || ($form->isSubmit("addPhoto")) &&($form->isValid())){
                    
                    $new_souvenir = new Article([
                        "titre_article" 	=> ucfirst($http->getDataPost("titre_article")),
                        "description_article" 	=> ucfirst($http->getDataPost("description_article")),
                        "date_article" 	=> $http->getDataPost("date_article"),
                        "actif_article" 	=> 0, 
                        "validation_article" 	=> 0
                    ]);
                    // je recupère les baby selectioner pour l'ajout souvenir tribu
                    $pattern = "/^baby[0-9]+$/";
                    $values = $http->getDataMultipleChoice($pattern);
                    // j'ajout d'habord l'article et recupère son id
                    $managerA = new ManagerArticle($cx);
                    $new_id_article = $managerA->insertArticle($new_souvenir);
                    if($new_id_article > 0) {
                        //Insertion dans la table baby_has_article
                        if(!empty($values)){
                            foreach ($values as $id_baby) {
                                $managerA->insertArticleHasbaby($id_baby, $new_id_article);
                            }
                            if(($form->isSubmit("addPhoto")) && ($form->isValid())){
                                $flash->setFlash("Votre proposition de souvenir a bien été envoyer. Ajouter lui des photos !");
                                header("location: tribu-ajouter-photos-souvenir-".$new_id_article."");
                                exit();
                            }               
                            $flash->setFlash("Votre proposition de souvenir a bien été envoyer !");
                        }else{
                            $flash->setFlash("Impossible d'envoyer un souvenir. Veuillez réesayer ou contacter l'équipe <span class=\"flash-logo\">Picmento</span> !");
                        }
                    header("location: voir-tribu-amis-".$id_user."");
                        exit();
        
                    }
                }
                $cx->close();
                return $general;
        
                }else{
                    $flash->setFlash("Pour ajouter un souvenir la tribu doit être composée d'au moins un enfant !");
                    header("location: voir-tribu-amis-".$id_user."");
                    exit();
    
                }


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

