<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class UploadMaxSizeValidator extends Validator {

	private $size;
	private $maxSize;

	function __construct($message,$size,$maxSize=512000000){
		parent::__construct($message);
		$this->size = $size;
		$this->maxSize = $maxSize;
	}


	function isNotValid($saisie) {
		return($this->size > $this->maxSize);
	}

}
