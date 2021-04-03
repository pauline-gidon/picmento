<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class SpecialCharValidator extends Validator {

	function isNotValid($saisie){
		return !preg_match("/\W+/",$saisie);
	}

}
