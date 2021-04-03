<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class UploadCodeValidator extends Validator {

	private $codeError;

	function __construct($message,$code){
		parent::__construct($message);
		$this->codeError = $code;
	}


	function isNotValid($saisie) {
		return($this->codeError > 0);
	}

}
