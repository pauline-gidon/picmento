<?php
namespace ORM\Article\Controller;
// use OCFram\Navbaby;
use OCFram\Connexion;
use OCFram\Controller;

use OCFram\HTTPRequest;
// use ORM\Article\Entity\Article;
use Vendors\Flash\Flash;

use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use ORM\Tribu\Model\ManagerTribu;
use ORM\Article\Model\ManagerArticle;
use ORM\Commentaire\Model\ManagerCommentaire;

class AmisAfficherSouvenirsBaby extends Controller {

	// use Navbaby;

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Les souvenirs");
		$this->setView("ORM/Article/View/ami-afficher-souvenirs-baby.php");
		
		$http 				= new HTTPRequest();
		$id_baby 	= $http->getDataGet("id");
		$cx			= new Connexion();
		$managerT = new ManagerTribu($cx);
        //je recupère la tribu de du baby pour recupérer les parents 
        $tribu = $managerT->oneTribuByIdBaby($id_baby);
        $id_parent1 = $tribu->getUserIdParent1();
        $id_parent2 = $tribu->getUserIdParent2();
		$managerU = new ManagerUser($cx);
        // et verifier si la personne est amis avec l'un des deux parent
        $user = $managerU->verifUserAmisUserConnecter($id_parent1, $id_parent2);
        if(!is_null($user)){
            $manager1	= new ManagerBaby($cx);
            // construction nav baby
            // $babys=  $manager1->allBabyHasUser();
            // $this->navConstruction($babys);
            $baby = $manager1->oneBabyById($id_baby);
            $general["baby"] =  $baby;
            if(!is_null($baby)){

                
                $manager = new ManagerArticle($cx);
                
                $articles = $manager->fullArticleActifWithMedias($id_baby);
                // $articles = [
                //     "articles" => $articles
                // ];
               // $general[] = $articles;
                // $articles_c = $manager->fullArticleWithCommentaire($id_baby);
                // $id_user_com = $articles->get
                //il faudra que je gère l'affichage des commantire $generale[] = $commentaires
                if(is_null($articles)){
                    $flash = new Flash;
                    $flash->setFlash("Cette enfant n'a pas encore de souvenir à vous raconter !");
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

                $cx->close();
                return $general;
            }
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
		
		

		
			
	}
}


		


