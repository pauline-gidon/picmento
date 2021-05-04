<?php
namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\Connexion;
use OCFram\HTTPRequest;

use ORM\Article\Model\ManagerArticle;
// use ORM\Article\Entity\Article;
use ORM\Baby\Model\ManagerBaby;

use Vendors\Flash\Flash;
use OCFram\Navbaby;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\User\Model\ManagerUser;

class AfficherSouvenirsBaby extends Controller {

	use Navbaby;

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Les souvenirs");
		$this->setView("ORM/Article/View/afficher-souvenirs-baby.php");
		
		$http 				= new HTTPRequest();
		$id_baby 	= $http->getDataGet("id");
		$cx			= new Connexion();
		$managerU = new ManagerUser($cx);
        if($managerU->verifUserBaby($id_baby)){

            $manager1	= new ManagerBaby($cx);
            $babys=  $manager1->allBabyHasUser();
            $this->navConstruction($babys);
            $baby = $manager1->oneBabyById($id_baby);
            $general["baby"] =  $baby;
            if(!is_null($baby)){

                $nom = $baby->getNomBaby();
                
                $manager = new ManagerArticle($cx);
                
                $articles = $manager->fullArticleWithMedias($id_baby);
                // $articles = [
                //     "articles" => $articles
                // ];
               // $general[] = $articles;
                // $articles_c = $manager->fullArticleWithCommentaire($id_baby);
                // $id_user_com = $articles->get
                //il faudra que je gère l'affichage des commantire $generale[] = $commentaires
                if(is_null($articles)){
                    $flash = new Flash;
                    $flash->setFlash("Votre enfant n'a pas encore de souvenir, lancez-vous !");
                }else{
                    // $general[]= $articles;
                    $general["articles"] = [];
                    foreach($articles as $article){
                        $wrapArticle = [ 
                            "souvenir" => $article,
                            "commentaires" => [], 
                        ];
                        $id_article = $article->getIdArticle();
                        $coms = $manager->oneArticleWithCommentaireByIdArticle($id_article);
                        if(!is_null($coms)){
                            foreach($coms as $com){
                                array_push($wrapArticle["commentaires"], $com);
                            }
                        }
                        // array_push($tableau,$coms);
                        
                        array_push($general["articles"],$wrapArticle);
                        
                        // $id_user_com= $article_c->liste_is_user_com;
                    }
                   //$general[] =$articles;
                        // array_push($general,$articles); 

                        
                    // $general[] = $articles_c;

                }

                return $general;
            }
            $cx->close();
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
		
		

		
			
	}
}


		


