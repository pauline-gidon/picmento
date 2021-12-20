<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class PoidsValidator extends Validator {

	function isNotValid($saisie){
		$erreur = FALSE;

        if(!is_numeric($saisie)){
            $erreur = TRUE;

        }elseif(!preg_match("/^[0-9]{1}.[0-9]{3}$/",$saisie) && !preg_match("/^[0-9]{1}$/",$saisie)){
            
            $erreur = TRUE;
        }
            
        if(strlen($saisie) == 1){
           
            $saisieOK =  explode(".",$saisie);
                if(gmp_sign($saisieOK[0]) <= 0 ){
                    $erreur = TRUE;
                }
        }
        


		return $erreur;
	}

}

