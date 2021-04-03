<?php
namespace OCFram;
use OCFram\Router;

class Application {
	//Elle se sert du Router, pour voir s'il est capable de lui retourner un objet Route
	private $route_valide;

	//Grâce à cette route valide, l'Application va pouvoir instancier et retourner un Controller qui fera le reste du job (avec le Manager, la View...)
	private $controller;

	//Mon site ne peut rien afficher d'autre qu'une 404 s'il n'a pas de route valide. Mon Application est totalement dépendante d'un objet Router censé lui fournir une Route
	function __construct(Router $router){
		$this->route_valide = $router->getRoute(); //Route || NULL
	}


	function getController(){
		if(!is_null($this->route_valide)){
			//ORM\Activite\Controller\AfficherActiveActivites
			$this->controller = $this->route_valide->getNamespace()."\\".$this->route_valide->getModule()."\Controller\\".$this->route_valide->getAction();

			if($this->route_valide->getLogged() === true){
				if(!isset($_SESSION["auth"])){
					$this->controller = null;
				}else{
					if($_SESSION["auth"]["statut"] < $this->route_valide->getDroits()){
						$this->controller = null;
					}
				}
			}
		}
		//new ORM\Activite\Controller\AfficherActiveActivites()
		return !is_null($this->controller)? new $this->controller() : die(include("errors/404.php"));
		
	//Fermeture de la méthode getController()
	}

//Fermeture de ma classe
}