<?php
namespace Vendors\Validator;
use DateTime;
use Vendors\Validator\Validator;

class PoidsValidator extends Validator {

	function isNotValid($saisie){
		$erreur = FALSE;

        if(!is_numeric($saisie)){
            $erreur = TRUE;

        }elseif(!preg_match("/^[0-9]{1}.[0-9]{3}$/",$saisie)){
            $erreur = TRUE;

        }else{
            $saisieOK =  explode(".",$saisie);
            if(gmp_sign($saisieOK[0]) <= 0 ){
                $erreur = TRUE;
            }
        }


		return $erreur;
	}

}

