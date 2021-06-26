<?php
namespace ORM\Article\Controller;
// use OCFram\Navbaby;
use OCFram\Connexion;
use OCFram\Controller;

use OCFram\HTTPRequest;
use ORM\Amis\Model\ManagerAmis;
// use ORM\Article\Entity\Article;
use Vendors\Flash\Flash;

use ORM\Baby\Model\ManagerBaby;
use ORM\User\Model\ManagerUser;
use ORM\Tribu\Model\ManagerTribu;
use ORM\Article\Model\ManagerArticle;
use OCFram\Navbaby;
use ORM\Commentaire\Model\ManagerCommentaire;

class AmisAfficherSouvenirsBaby extends Controller {

	use Navbaby;

	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Les souvenirs de <br>");
		$this->setView("ORM/Article/View/ami-afficher-souvenirs-baby.php");
		
		$http 				= new HTTPRequest();
		$id_baby 	= $http->getDataGet("id");
		$cx			= new Connexion();
		$managerU = new ManagerUser($cx);
        //une variable de session a été crée à, l'affichage des tribu de mon amis avec id ami $_SESSION["ami"]["id"]
        //je verifie si la personne connecter et le profil visité son bien amis
        //je recupère la tribu de du baby pour recupérer les parents 
        $id_user = $_SESSION["ami"]["id"];
        $manager1	= new ManagerBaby($cx);
        $babys=  $manager1->allBabyHasUserAmi($id_user);

        $this->navConstruction($babys);

        if($managerU->verifUserAmis($id_user)){
            //je verifie si ce baby appartien bien a id du parent
            if($managerU->verifUserBaby($id_baby, $id_user)){
                   $managerB = new ManagerBaby($cx);
                    //je vais cherche les info du baby pour affichage personalisé
                    $baby = $managerB->oneBabyById($id_baby);
                    $general["baby"] =  $baby;
                    if(!is_null($baby)){
                        $manager = new ManagerArticle($cx);
                        //je recupère les souvenirs du baby
                        $articles = $manager->fullArticleActifWithMedias($id_baby);

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
                                    "commun" =>[],
                                ];
                                $id_article = $article->getIdArticle();
        
                                $babys = $manager->fullArticleHasBaby($id_article);
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
                    }else{
                        header("location: ".DOMAINE."errors/404.php");
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


		


