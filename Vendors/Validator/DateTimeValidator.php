<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class DateTimeValidator extends Validator {

	function isNotValid($saisie){
		$erreur = FALSE;
		if(!preg_match(
			"/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/",
			$saisie
		)){
			$erreur = TRUE;
		}else{
			list($year,$month,$day) = explode("-",substr($saisie,0,10));
			list($heure,$minute,$seconde) = explode(":",substr($saisie,11,8));
			
			if(
				(!checkdate($month,$day,$year))||
				($heure > 23)||
				($minute > 59)||
				($seconde > 59)
			){
				$erreur = TRUE;
			}
		}

		return $erreur;
	}

}

