<?php
namespace Vendors\FormBuilder;
use OCFram\HTTPRequest;

class Form {
	private $action;
	private $method;
	//Un formulaire est une collection d'éléments
	private $fields = [];
	//Les champs du form peuvent être alimentés soit par du POST ou du GET...
	private $http;
	//Soit par les valeurs d'une Entity (ex. : form pré rempli de modification)
	private $entity;

	function __construct($m="post",$e=NULL,$a=NULL){
		$this->http 		= new HTTPRequest();
		$this->method 	= $m;
		$this->entity 	= $e;
		if(!is_null($a)){
			$this->action = $a;
		}else{
			$this->action = $this->http->getUri();
		}
	}

	//Un formulaire est une collection de champs
	function add(Field $field){
		//Chaque objet Champ est ajouté au tableau d'objets (un tableau de Champs)
		$this->fields[] = $field;

		//On en profite pour vérifier si le champ doit être pré-rempli
		$this->filled($field);
	}

	function filled($field){
		//- Soit parce qu'on a reçu une valeur POST
		if(!is_null($this->http->getDataPost($field->getName()))){
			$val = $this->http->getDataPost(
				$field->getName(),
				$field->getSecurity()
			);
			$this->fullfilled($field,$val);
		//- Soit parce qu'on a reçu une valeur GET
		}else if(!is_null($this->http->getDataGet($field->getName()))){
			$val = $this->http->getDataGet(
				$field->getName()
			);
			$this->fullfilled($field,$val);
		//- Soit parce qu'on a reçu une Entity issue d'une requête à la BDD
		}else if(!is_null($this->entity)){
			$methodEntity = $field->getGetterEntity();
			if(!is_null($methodEntity)) {
				if(is_array($this->entity)){
					foreach ($this->entity as $obj) {
						 if(method_exists($obj,$methodEntity)){
						  $val = $obj->$methodEntity();
						  $this->fullfilled($field,$val);
						 }
					}
				}else{
					if(method_exists($this->entity,$methodEntity)){
						$val = $this->entity->$methodEntity();
						$this->fullfilled($field,$val);
					}

				}
				
			}
		}
	}

	function fullfilled($field,$val){
		//Et on l'affecte au champ si elle existe
		if(isset($val)){
			if($field instanceof Select){
				foreach($field->getOptions() as $option){
					if($val == $option->getValue()){
						$option->setSelected(TRUE);
					}
				}
			}

			if(
				($field instanceof InputRadio)
				||($field instanceof InputCheckBox)
				||($field instanceof Option)
			){
				if($val == $field->getValue()){
					$field->setSelected(TRUE);
				}
			}else{
				$field->setValue($val);
			}

		}
	}

	function getForm(){
		$html ="<form action=\"".$this->action."\" method=\"".$this->method."\" 
		enctype=\"multipart/form-data\">";

		foreach($this->fields as $champ){
			$html .= "<p>".$champ->getWidget()."</p>";
		}

		$html .= "</form>";

		return $html;
	}

	//Dans la classe Field, on a vérifié si un champ était valide
	//Dans la classe Form, nous allons vérifier si le formulaire est valide
	//pour lancer le traitement final
	function isValid() {
		$ok = TRUE;
		//Chaque isValid de chaque champ retourne-t-il que c'est valide ou pas
		foreach($this->fields as $field){
			if(!$field->isValid()){
				$ok = FALSE;
			}
		}
		return $ok;
	}

	//Le formulaire a-t-il été sousmis (si oui et si valide, alors traitement final
	function isSubmit($nom){
		return ($this->http->postExist($nom))?TRUE:FALSE;
	}

}
