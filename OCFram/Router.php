<?php
namespace OCFram;
use OCFram\Route;
use OCFram\HTTPRequest;

class Router{
	private $routes;
	private $uri;


	function __construct(Array $tableau){
		$this->routes 	= $tableau;
		$http 			= new HTTPRequest();
		$this->uri 		= $http->getUri();
	}

	//Méthode personnalisée permettant de trouver la bonne route
	//dans toutes celles fournies par route.php
	function getRoute(){
		foreach($this->routes as $route) {
			if(preg_match("/^".str_replace("/","\/",$route["url"])."$/",$this->uri)){
				return new Route($route);
			}
		}
	}

}
