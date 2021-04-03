<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class NotEgalValidator extends Validator {

	private $saisie2;

	function __construct($message,$saisie2){
		parent::__construct($message);
		$this->saisie2 = $saisie2;
	}

	function isNotValid($saisie1){
		return $this->saisie2 == $saisie1;
	}

}

