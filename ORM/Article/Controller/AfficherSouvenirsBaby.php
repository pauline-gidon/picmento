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
use Vendors\Recherche;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\User\Model\ManagerUser;

class AfficherSouvenirsBaby extends Controller {

	use Navbaby;
    // use Recherche;

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Les souvenirs de");
		$this->setView("ORM/Article/View/afficher-souvenirs-baby.php");
		
		$http 				= new HTTPRequest();
		$id_baby 	= $http->getDataGet("id");
        $_SESSION["idBaby"] = $id_baby;
      
		$cx			= new Connexion();
		$managerU = new ManagerUser($cx);
        $id_user = $_SESSION["auth"]["id"];
        // $this->Rechercher();
        if($managerU->verifUserBaby($id_baby, $id_user)){

            $manager1	= new ManagerBaby($cx);
            $id_user = $_SESSION["auth"]["id"];
            $babys=  $manager1->allBabyHasUser($id_user);
            $this->navConstruction($babys);
            $baby = $manager1->oneBabyById($id_baby);
            if(!is_null($baby)){
                $general["baby"] = $baby;

                $nom = $baby->getNomBaby();
                
                $manager = new ManagerArticle($cx);
                //aller chercher tous les article du baby
                $articles = $manager->fullArticleWithMedias($id_baby);

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
                            "commun" =>[],
                        ];
                        $id_article = $article->getIdArticle();
                        //je verifie si cette article est lié a un souvenir communs
                        $babys = $manager->fullArticleHasBaby($id_article);
                        //si c'est le cas je crée un resulat pour un affichage personalisé
                        $resultcount = 0;
                        if(count($babys) > 1){
                            $resultcount ++;
                        }
                        array_push($wrapArticle["commun"], $resultcount);
                        $coms = $manager->oneArticleWithCommentaireByIdArticle($id_article);
                        if(!is_null($coms)){
                            foreach($coms as $com){
                                array_push($wrapArticle["commentaires"], $com);
                            }
                        }

                        
                        array_push($general["articles"],$wrapArticle);
                        

                    }


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


		


