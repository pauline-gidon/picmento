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


class SupprimerBaby extends Controller {

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Supprimer le profil");
		$this->setView("ORM/Baby/View/form-baby-tribu.php");
		
		$http = new HTTPRequest();
		$id = $http->getDataGet("id");
		$cx			= new Connexion();
		$manager	= new ManagerBaby($cx);
		$baby 		= $manager->oneBabyById($id);
		if(!is_null($baby)){

				//Je récupère son id de baby
				$id_baby	= $baby->getIdBaby();
				//Je vais chercher tous les articles lié a ce baby et ces medias
		        $manager1	= new ManagerArticle($cx);

				$articles 	= $manager1->fullArticle($id_baby);

				
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
                                $manager3 = new ManagerMedias($cx);
                                $manager3->deleteMediasById($idmedia);
                            }
                        }
                        $manager2 = new ManagerCommentaire($cx);
                        $commentaires = $manager2->commentaireHasArticleById($id_article);
                        // var_dump($idmedias);die();
                        if(!is_null($commentaires)){

                            foreach($commentaires as $commentaire){

                                $id_com = $commentaire->getIdCommentaire();

                                $manager2->deleteCommentaireById($id_com);
                            }
                        }

						
                           
                            $manager1->deleteArticleById($id_article);

					
                                                    
					

				
					//Je supprime les baby
				}
                
                
                
            }		
             $manager->deleteBabyById($id_baby);
	
		
            header("Location: afficher-tribu");

				
		}
    }


}
	


		


