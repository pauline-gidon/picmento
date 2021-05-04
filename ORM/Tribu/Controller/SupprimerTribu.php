<?php
namespace ORM\Tribu\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;
use ORM\Amis\Model\ManagerAmis;
// use OCFram\Manager;
use ORM\Tribu\Model\ManagerTribu;
// use ORM\Tribu\Entity\Tribu;
// use ORM\Article\Entity\Article;
use ORM\Baby\Model\ManagerBaby;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Timeline\Model\ManagerTimeline;
// use Vendors\FormBuilded\FormTribu;

use Vendors\Flash\Flash;

class SupprimerTribu extends Controller {

	function getResult() {
		$this->setLayout("back");
		$this->setTitle("Supprimer la tribu");
		$this->setView("ORM/Tribu/View/form-tribu.php");
        $flash = new Flash(); 
		$http = new HTTPRequest();
		$id = $http->getDataGet("id");

		$cx			= new Connexion();
		$managerT	= new ManagerTribu($cx);
		//Vérification de la tribu en bdd
		$tribu 		= $managerT->oneTribuById($id);
		//Je récupère l'id de la tribu
		$id_tribu = $tribu->getIdTribu();  
        //je verifie que se soit bien le parent1 de connecter
        if($tribu->getUserIdParent1() == $_SESSION["auth"]["id"]){
            //je verifie si cette tribu a un deuxième parent
            $parent2 = $tribu->getUserIdParent2(); 
            if((is_null($parent2))){
    
                $managerB	= new ManagerBaby($cx);
                //Je vais chercher tous les babys lié a la tribu
                $babys = $managerB->tribuHasBaby($id_tribu);
                //Pour chaque baby trouvé:
        
                if(!is_null($babys)){
        
                    foreach ($babys as $baby) {
                        //Je récupère son id de baby
                        $id_baby	= $baby->getIdBaby();
                        //Je vais chercher tous les articles lié a ce baby et ces medias
                        $managerA	= new ManagerArticle($cx);    
                        $articles 	= $managerA->fullArticleWithMedias($id_baby);
                          
                        //Si ce n'est pas null
                        if(!is_null($articles)){
                            
                            foreach($articles as $article){    
                                //Je recupère l'id d'article
                                $id_article = $article->getIdArticle();
                                //je recupère les ids de media lié a son article
                                $idmedias = $article->liste_id;
                                if(!is_null($idmedias)){
                                    //j'explode la liste d'id
                                    $idmedias = explode("/", $idmedias);
                                    foreach($idmedias as $idmedia){
                                        $managerM = new ManagerMedias($cx);
                                        //je supprime les media par leur id
                                        $managerM->deleteMediasById($idmedia);
                                    }
                                    //je recupère les nom pour les supprimer dans le dossier de l'hebergeur
                                    $nomphotos = $article->liste_photo;
                                    $nomphotos = explode("/", $nomphotos);
                                    foreach ($nomphotos as $nomphoto) {
                                        $destination = "medias/souvenir/";
                                    unlink($destination.$nomphoto);
                                    }

                                }
                                // je vais chercher tous les commentaire de l'article
                                $managerC = new ManagerCommentaire($cx);
                                $commentaires = $managerC->fullCommentaireByIdArticle($id_article);
                                if(!is_null($commentaires)){
        
                                    foreach($commentaires as $commentaire){
                                        //je recupère l'id du commentaire
                                        $id_com = $commentaire->getIdCommentaire();
                                        //je supprimer le commentaire
                                        $managerC->deleteCommentaireById($id_com);
                                    }
                                }
                                $managerA->deleteArticleHasBaby($id_article, $id_baby);
                                $managerA->deleteArticleByIds($id_article);
                            }
                            
                        }	
                        $managerTimeline = new ManagerTimeline($cx);
                        //je vais chercher les photo de sa timeline
                        $timelines = $managerTimeline->oneTimelineByIdBaby($id_baby);
                        if(!is_null($timelines)){
                            foreach($timelines as $timeline)
                            //je recupère le nom des photos de la timeline
                            $photos[] = $timeline->getNomPhotoTimeline();
                            foreach ($photos as $photo) {
                                //je supprime les photos dans le dossier media du site de l'hebergeur
                                $destination = "medias/timeline/";
                                unlink($destination.$photo);
                            }
                            // je les supprime toute d'un coup grace a l'id de baby
                            $managerTimeline->deteleTimelineByIdBaby($id_baby);
                        }
            
    
                        $managerB->deleteBabyById($id_baby);
            
                    }
            
                }
                //je regarde si une demande d'association de parent a été envoyé avec cet id de tribu
                $managerAmis = new ManagerAmis($cx);
                $amis = $managerAmis->oneAmisByIdTribu($id_tribu);
                if(!is_null($amis)){
                    //si il y en a une je la supprime elle a forcement pas été accépté sinon un deuxième parent aurai été affecter
                   $managerAmis->deleteAmisByIdTribu($id_tribu);
                }
                    //Je peux enfin supprimer la tribu
                if($managerT->deleteTribu($id_tribu)){
                    $flash->setFlash("Votre tribu a bien été supprimée");
                    header("location: afficher-tribu");
                    exit();
                }else{
                    $flash->setFlash("Impossible de supprimer la tribu réesayez ou contactez l'équipe <span class=\"flash-logo\">Picmento</span> !");
    
                }
                
    
            }else{
                $flash->setFlash("La tribu ne peut pas être supprimer car elle est associé a un deuxième parents !");
            }

        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
	}
}




		


