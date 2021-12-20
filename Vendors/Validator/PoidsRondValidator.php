<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class PoidsRondValidator extends Validator {

	function isNotValid($saisie){
		$erreur = FALSE;

        if(!is_numeric($saisie)){
            $erreur = TRUE;

        }elseif(!preg_match("/^[0-9]{1}$/",$saisie)){
            $erreur = TRUE;
            
        }elseif($saisie >= 6 ){
            $erreur = TRUE;
        }

        


		return $erreur;
	}

}

