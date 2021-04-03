<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;
use OCFram\HTTPRequest;

class IssetValidator extends Validator {
	private $http;
	private $nom_champ;

	function __construct($message,$nom){
		parent::__construct($message);
		$this->http = new HTTPRequest();
		$this->nom_champ = $nom;
	}

	function isNotValid($saisie){
		return (!($this->http->postExist($this->nom_champ)));
	}

}

