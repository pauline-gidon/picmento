<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\EmailValidator;

class FormAmi extends Form {


	function buildForm(){

		$this->add(new InputEmail([
			"label" 		=> "L'adresse mail",
			"name" 			=> "email_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 	=> [
				new EmailValidator("Adresse mail valide obligatoire")
			]
		]));

		$this->add(new InputSubmit([
			"name" 			=> "go",
			"cssChamp" 			=> "slide-hover-left",
			"value" 		=> "Envoyer"
		]));

		return $this;

	}

}

