<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class NumberValidator extends Validator {

	function isNotValid($saisie){
		return !is_numeric($saisie);
	}

}

