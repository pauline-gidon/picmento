<?php
namespace Vendors\Validator;
use DateTime;
use Vendors\Validator\Validator;

class MonthNowValidator extends Validator {

	function isNotValid($saisie){
        $erreur = FALSE;
		if(!preg_match(
            "/^[0-9]{2}$/",
			$saisie
            )){
                $erreur = TRUE;
            }else{
                               
                $now = new DateTime('NOW');
                $m = date_format($now,'m');
              
                if($saisie > $m){
                    $erreur = TRUE;
                }
               
		}
		return $erreur;
	}

}

