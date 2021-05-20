<?php
namespace Vendors\FormBuilder;
use OCFram\Hydrator;

class Field {
	use Hydrator;
	protected $label;
	protected $name;
	protected $id;
	protected $value;
	protected $placeholder;
	protected $cssLabel;
	protected $cssChamp;

	protected $selected = FALSE;

	protected $validators = [];
	protected $errorMessage;

	protected $security = 3;
	protected $getterEntity;



	function __construct(Array $array){
		$this->hydrate($array);
	}

	//Pas besoin de tous les getters et setters
	//Dans le cas d'un form qui a été soumis, il faut pouvoir...
	//- Ré-affecter l'attribut value (préservation de la saisie)
	function setValue($val){
		$this->value = $val;
	}
	
	//- Récupérer cette value (la saisie) pour la tester par ex.
	function getValue(){
		return $this->value;
	}
	//- Spécifier q'un radio, checkbox ou une option peuvent être selected ou checked
	function setSelected($val=TRUE){
		$this->selected = $val;
	}
	//- Récupérer le nom du champ pour interroger son $_POST["nom"]
	function getName(){
		return $this->name;
	}
	//- Récupérer le niveau de nettoyage ou de sécurité que je souhaite voir appliqué à ce champ
	function getSecurity(){
		return $this->security;
	}
	//- Récupérer la méthode permettant d'alimenter le champ via une entité
	function getGetterEntity(){
		return $this->getterEntity;
	}


	//UNE METHODE QUI PARCOURE LES VALIDATORS ET AFFECTE LEURS MESSAGES D'ERREURS à $errorMessage
	function isValid(){
		$ok = TRUE;
		foreach($this->validators as $validator){
			if($validator->isNotValid($this->value)){
				$this->errorMessage = $validator->getError();
				$ok = FALSE;
			}
		}
		return $ok;
	}



}
