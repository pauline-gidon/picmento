<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class MonthValidator extends Validator {

	function isNotValid($saisie){
		$erreur = FALSE;
		if(!preg_match("/^[0-9]{2}$/",$saisie)){
                $erreur = TRUE;
            }else{
                

                if($saisie > 12){
                    $erreur = TRUE;
                }
                if($saisie == 00){
                    $erreur = TRUE;
                }     
            }
            return $erreur;

    }

}