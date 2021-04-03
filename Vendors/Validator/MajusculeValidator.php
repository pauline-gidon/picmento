<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class MajusculeValidator extends Validator {

	function isNotValid($saisie){
		return !preg_match("/[A-Z]+/",$saisie);
	}

}
