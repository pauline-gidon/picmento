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

class AfficherSouvenirsProposer extends Controller {
    
    use Navbaby;
    
	function getResult() {
        $this->setLayout("back");
		$this->setTitle("Les souvenirs proposer");
		$this->setView("ORM/Article/View/afficher-souvenirs-proposer.php");
		
		$http 				= new HTTPRequest();
        $flash = new Flash();
		$cx			= new Connexion();
		$managerA = new ManagerArticle($cx);
        $managerU = new ManagerUser($cx);
        // je vais recupéré les proposition de souvenirs qui sont en validation zero
        $souvenirs = $managerA->fullArticlesValidationZero();
        $general = [];
        if(!is_null($souvenirs)){
            foreach ($souvenirs as $souvenir) {
                $user_auteur = $managerU->oneUserById($souvenir->getUserIdUser());
                $souvenir_recu = [ 
                    "article" => $souvenir,
                    "auteur" => [],
                ];

                array_push($souvenir_recu["auteur"],$user_auteur);
                array_push($general,$souvenir_recu);
            }
            $cx->close();
            return $general;
            exit();
        }else{
            $flash->setFlash("Aucune proposition de souvenirs reçus !");
            header("location: amis");
            exit();
        }
					
	}
}


		


