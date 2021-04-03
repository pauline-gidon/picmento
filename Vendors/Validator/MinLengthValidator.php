<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class MinLengthValidator extends Validator {
	private $mini;

	function __construct($message, $long_mini){
		parent::__construct($message);
		$this->mini = $long_mini;
	}

	function isNotValid($saisie){
		//return 13 < 8 : TRUE
		return strlen($saisie) < $this->mini;
	}


}
