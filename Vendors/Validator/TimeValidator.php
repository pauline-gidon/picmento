<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class TimeValidator extends Validator {

	function isNotValid($saisie){
		$erreur = FALSE;
		if(!preg_match("/^[0-9]{2}:[0-9]{2}$/", $saisie)){
			$erreur = TRUE;
		}else{
			list($heure,$minute) = explode(":",substr($saisie,0,5));
			if(
				($heure > 23)||($minute > 59)
			){
				$erreur = TRUE;
			}
		}
		return $erreur;
	}
}

