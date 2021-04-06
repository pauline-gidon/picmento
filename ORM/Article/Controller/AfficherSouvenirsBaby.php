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
            if(!is_null($baby)){

                $nom = $baby->getNomBaby();
                $general[] = $baby;
        
                $cx = new Connexion();
                $manager = new ManagerArticle($cx);
                
                $articles = $manager->fullArticle($id_baby);
                //il faudra que je gère l'affichage des commantire $generale[] = $commentaires
                if(is_null($articles)){
                    $flash = new Flash;
                    $flash->setFlash("Votre enfant n'a pas encore de souvenir, lancez-vous !");
                }else{
        
                    $general[] = $articles;
                }
                foreach ($articles as $article) {
                    $id_article = $article->getIdArticle(); 
                    $managerC = new ManagerCommentaire($cx);
                    $commentaires = $managerC->fullCommentaireByIdArticle($id_article);
                    // var_dump($commentaires);die();
                    if(!is_null($commentaires)){
                        $general[] = $commentaires;
                        foreach($commentaires as $commentaire){
                            $id_user = $commentaire->getUserIdUser();
                            $user = $managerU->oneUserById($id_user);
                            $general[] = $user;
                        }
                    }
                }

            }
            $cx->close();
            return $general;
        }else{
            header("location: ".DOMAINE."errors/404.php");
            exit();
        }
		
		

		
			
	}
}


		


