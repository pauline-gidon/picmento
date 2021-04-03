<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class UploadVideValidator extends Validator {

	private $file;

	function __construct($message,$file){
		parent::__construct($message);
		$this->file = $file;
	}


	function isNotValid($saisie) {
		return empty($this->file);
	}

}
