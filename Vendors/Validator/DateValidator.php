<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class DateValidator extends Validator {

	function isNotValid($saisie){
		$erreur = FALSE;
		if(!preg_match(
			"/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",
			$saisie
		)){
			$erreur = TRUE;
		}else{
			list($year,$month,$day) = explode("-",substr($saisie,0,10));
			
			if((!checkdate($month,$day,$year))){
				$erreur = TRUE;
			}
		}

		return $erreur;
	}

}

