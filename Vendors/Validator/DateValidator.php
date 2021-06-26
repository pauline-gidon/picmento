<?php
namespace Vendors\Validator;
use DateTime;
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
                $now = new DateTime('NOW');
                $y = date_format($now,'Y');
                $m = date_format($now,'m');
                $d = date_format($now,'d');
                if($year > $y){
                    $erreur = TRUE;
                }
                if (($year == $y) && ($month > $m)) {
                    $erreur = TRUE;
                }
                if (($year == $y) && ($month == $m) && ($day > $d)){
                    $erreur = TRUE;
                }
		}
		return $erreur;
	}

}

