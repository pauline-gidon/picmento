<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\EmailValidator;

class FormMail extends Form {


	function buildForm(){

		$this->add(new InputEmail([
			"label" 		=> "Votre adresse mail : ",
			"name" 			=> "email_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"placeholder" 	=> "Votre adresse e-mail",
			"validators" 	=> [
				new EmailValidator("Adresse mail valide obligatoire")
			]
		]));

		$this->add(new InputSubmit([
			"name" 			=> "go",
			"cssChamp" 			=> "btn",
			"value" 		=> "Recevoir"
		]));

		return $this;

	}

}

