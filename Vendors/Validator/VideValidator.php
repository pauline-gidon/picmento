<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class VideValidator extends Validator {

	function isNotValid($saisie){
		return empty($saisie);
	}

}
