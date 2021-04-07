<?php
namespace ORM\Tribu\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;
use OCFram\Connexion;
// use OCFram\Manager;
use ORM\Tribu\Model\ManagerTribu;
// use ORM\Tribu\Entity\Tribu;
// use ORM\Article\Entity\Article;
use ORM\Baby\Model\ManagerBaby;
use ORM\Medias\Model\ManagerMedias;
use ORM\Article\Model\ManagerArticle;
use ORM\Commentaire\Model\ManagerCommentaire;
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

				$articles 	= $managerA->fullArticle($id_baby);

				
				//Si ce n'est pas null
				if(!is_null($articles)){
					
					foreach($articles as $article){

						//Je recupère les ids d'articles
						$id_article = $article->getIdArticle();
                        // $manager3->deleteArticleById($id_article);
                        $idmedias = $article->liste_id;


                        if(!is_null($idmedias)){
                            $idmedias = explode("/", $idmedias);
                            foreach($idmedias as $idmedia){
                                $managerM = new ManagerMedias($cx);
                                $managerM->deleteMediasById($idmedia);
                            }
                        }
                        $managerC = new ManagerCommentaire($cx);
                        $commentaires = $managerC->commentaireHasArticleById($id_article);
                        // var_dump($idmedias);die();
                        if(!is_null($commentaires)){

                            foreach($commentaires as $commentaire){

                                $id_com = $commentaire->getIdCommentaire();

                                $managerC->deleteCommentaireById($id_com);
                            }
                        }
          
                            $managerA->deleteArticleById($id_article);
				}

            }		
             $managerB->deleteBabyById($id_baby);
	
			}
	
		}
			//Je peux enfin supprimer la tribu
			if($managerT->deleteTribu($id)){
                $flash->setFlash("Votre tribu a bien été supprimée");
            }else{
                $flash->setFlash("Impossible de supprimer la tribu réesayez ou contactez l'équipe <span class=\"flash-logo\">Picmento</span> <a href=\"afficher-tribu\" title=\"Retour Tribu\" class=\"flash-retour\"><i class=\"fas fa-undo-alt\"></i> Retour</a>");

            }
			// header("location: afficher-tribu");
		
	}
}




		


