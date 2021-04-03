<?php
namespace OCFram;
use Vendors\Nettoyage\Chaine;

class Controller {
	protected $layout;
	protected $title;
	protected $view;

	//GETTERS
	function getLayout(){
		return $this->layout;
	}
	function getTitle(){
		return $this->title;
	}
	function getView(){
		return $this->view;
	}

	//SETTERS
	function setLayout($nom_template){
		$this->layout = "templates/".$nom_template."/layout.php";
	}
	function setTitle($val){
		$this->title = $val;
	}
	function setView($nom_vue){
		$this->view = $nom_vue;
	}


	//METHODES PERSONNALISEES
	function getClass(){
		$nettoyage = new Chaine();
		return $nettoyage->clear($this->title);
	}

}