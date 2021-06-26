<?php
namespace Vendors\Validator;
use DateTime;
use Vendors\Validator\Validator;

class YearValidator extends Validator {

	function isNotValid($saisie){
        $erreur = FALSE;
		if(!preg_match(
            "/^[0-9]{4}$/",
			$saisie
            )){
                $erreur = TRUE;
            }else{
                               
                $now = new DateTime('NOW');
                $y = date_format($now,'Y');
              
                if($saisie > $y){
                    $erreur = TRUE;
                }
               
		}
		return $erreur;
	}

}

