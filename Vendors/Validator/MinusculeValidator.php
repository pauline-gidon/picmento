<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class MinusculeValidator extends Validator {

	function isNotValid($saisie){
		return !preg_match("/[a-z]+/",$saisie);
	}

}
