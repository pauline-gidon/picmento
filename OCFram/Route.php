<?php
namespace OCFram;
use OCFram\Hydrator;

class Route {
	use Hydrator;
	private $url;
	private $namespace;
	private $module;
	private $action;
	private $logged;
	private $droits;

	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTER
	function getUrl(){
		return $this->url;
	}
	function getNamespace(){
		return $this->namespace;
	}
	function getModule(){
		return $this->module;
	}
	function getAction(){
		return $this->action;
	}
	function getLogged(){
		return $this->logged;
	}
	function getDroits(){
		return $this->droits;
	}

	//PAS DE SETTER, car les données d'une route sont fournies
	//par le fichier route.xml ou route.php
	//Ces données ne doivent pas être ouvertes à réaffectation (redéfinition)
}
