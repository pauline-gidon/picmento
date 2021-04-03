<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class SelectValidator extends Validator {

	function isNotValid($saisie){
		return $saisie == "ras";
	}


}
