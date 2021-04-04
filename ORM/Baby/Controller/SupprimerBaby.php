<?php
namespace ORM\Baby\Controller;
use OCFram\Connexion;
use OCFram\Controller;
use OCFram\HTTPRequest;
use Vendors\Flash\Flash;
// use ORM\Baby\Entity\Baby;
// use Vendors\File\Uploader;
use ORM\Baby\Model\ManagerBaby;
use ORM\Medias\Model\ManagerMedias;

use ORM\Article\Model\ManagerArticle;
// use Vendors\FormBuilded\FormBabyTribu;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Timeline\Model\ManagerTimeline;
use ORM\Tribu\Model\ManagerTribu;

class SupprimerBaby extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Supprimer le profil");
		$this->setView("ORM/Baby/View/form-baby-tribu.php");
		$flash = new Flash();
		$http = new HTTPRequest();
		$id = $http->getDataGet("id");
		$cx			= new Connexion();
		$manager	= new ManagerBaby($cx);
        //je recupère le baby par son id
		$baby 		= $manager->oneBabyById($id);
		if(!is_null($baby)){
            
            //Je récupère son id de baby
            $id_baby	= $baby->getIdBaby();
            $photo_baby = $baby->getPhotoBaby();
            $destination = "medias/photo-baby/";
            unlink($destination.$photo_baby);
            //suppression de la timeline
            $managerTimeline = new ManagerTimeline($cx);
            $timelines = $managerTimeline->oneTimelineByIdBaby($id_baby);
            if(!is_null($timelines)){
                $managerTimeline->deteleTimelineByIdBaby($id_baby);
                foreach($timelines as $timeline)
                    $photos[] = $timeline->getNomPhotoTimeline();
                    foreach ($photos as $photo) {
                        $destination = "medias/timeline/";
                        unlink($destination.$photo);
                    }

            }
            //Je vais chercher tous les articles lié a ce baby et les medias des articles
            $manager1	= new ManagerArticle($cx);
            $articles 	= $manager1->fullArticle($id_baby);
            if(!is_null($articles)){
                foreach($articles as $article){
                    $id_articles []= $article->getIdArticle();
                    // je parcours le tableau d'articles 
                    foreach($id_articles as $id_article){
                        //pour chaque article je vais supprimer la relation baby_has_article
                       $manager1->deleteArticleHasBaby($id_article,$id_baby);
                       
                       //je regarde pour chaque article si il sont associé a d'autre baby si c'est null je supprime tous se qui est en lien avec cet article
                        if(is_null($manager1->fullArticleHasBaby($id_article))){
                            //je recupère les id des media associé a l'article
 
                               $idmedias = $article->liste_id;
                                if(!is_null($idmedias)){
                                    $idmedias = explode("/", $idmedias);
                                    foreach($idmedias as $idmedia){
                                        //je supprime chaque medias
                                        $manager3 = new ManagerMedias($cx);
                                        $manager3->deleteMediasById($idmedia);
                                    }
                                }
                                //je recupère les nom des medias
                                $nom_medias = $article->liste_photo;
                                if(!is_null($nom_medias)){
                                    $nom_medias = explode("/", $nom_medias);
                                    //je parcour les medias pour aller les supprimer dans le dossier medias
                                    foreach ($nom_medias as $nom_media) {
                                        $destination = "medias/souvenir/";
                                        unlink($destination.$nom_media);
                                    }
                                }
                                // je regarde les commentaires associé a l'article
                                $manager2 = new ManagerCommentaire($cx);
                                $commentaires = $manager2->commentaireHasArticleById($id_article);
                                if(!is_null($commentaires)){
                                    
                                    foreach($commentaires as $commentaire){
                                        
                                        $id_coms []= $commentaire->getIdCommentaire();
                                        foreach($id_coms as $id_com){
                                            $manager2->deleteCommentaireById($id_com);
                                        }
                                    }
                                }
                                $manager1->deleteArticleByIds($id_article);
                                
                            }
                            //si il y a d'autre babys a associé aux l'articles
                        }
                        //foreach pour chaque id_article
                        
                    }
                      //foreach pour chaque article
                }
                
                // si il n'y as pas d'article associé a ce baby je delete le baby
                if($manager->deleteBabyById($id_baby)){
                    $flash->setFlash("Suppression effectuée");
                }else{
                    $flash->setFlash("Suppression impossible");
                }
            }
            //si ce baby exist
                header("Location: afficher-tribu");
    }		
}
    



	


		


