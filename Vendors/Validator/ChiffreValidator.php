<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class ChiffreValidator extends Validator {

	function isNotValid($saisie){
		return !preg_match("/[0-9]+/",$saisie);
	}

}

