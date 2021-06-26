<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\EmailValidator;

class FormAssociation extends Form {


	function buildForm(){

		$this->add(new InputEmail([
			"label" 		=> "L'adresse mail du 2eme parent",
			"name" 			=> "email_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"placeholder" 	=> "Bernard@gmail.com",
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

