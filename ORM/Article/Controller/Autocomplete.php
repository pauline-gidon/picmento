<?php


namespace ORM\Article\Controller;
use OCFram\Controller;
use OCFram\HTTPRequest;

use OCFram\Connexion;
use ORM\Article\Model\ManagerArticle;
use ORM\Article\View\AffichageAjax;

class Autocomplete extends Controller {

	use AffichageAjax;

	function getResult(){
		$http 			= new HTTPRequest();
		$saisie 		= urldecode($http->getDataPost("s",1));

		$cx 				= new Connexion();
		$manager 		= new ManagerArticle($cx);
        if(!empty($saisie)){
            $articles = $manager->autocompletion($saisie);
            $cx->close();
    
            if(!is_null($articles)){
                foreach($articles as $obj) {
                    $tableau[] = [
                        "id"			=> intval($obj->getIdArticle()),
                        "title" 	=> $obj->getTitreArticle()
                    ];
                }
        
                $this->affichage($tableau);
        
            }
    
        }

	}
}