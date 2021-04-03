<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;
use OCFram\HTTPRequest;

class MultipleChoiceValidator extends Validator {
	private $http;
	private $pattern;

	function __construct($message,$modele){
		parent::__construct($message);
		$this->http = new HTTPRequest();
		$this->pattern = $modele;
	}

	function isNotValid($saisie) {
		return(count($this->http->getDataMultipleChoice($this->pattern)) === 0);
	}

}
