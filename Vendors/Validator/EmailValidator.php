<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class EmailValidator extends Validator {

	function isNotValid($saisie){
		//Retourne moi si ça ne ressemble pas à une adresse mail
		//Retourne moi si OUI il y a une erreur (isNotValid TRUE)
		return !filter_var($saisie,FILTER_VALIDATE_EMAIL);
	}


}
