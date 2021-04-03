<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\EmailValidator;
use Vendors\Validator\VideValidator;

class FormContact extends Form {

	function buildForm(){

		$this->add(new InputEmail([
			"label" 				=> "Votre email ",
			"placeholder" 	=> "toto@toto.fr",
			"name" 					=> "email",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 		=> [
				new EmailValidator("Email obligatoire")
			]
		]));

		$this->add(new InputText([
			"label" 				=> "L'objet du message ",
			"name" 					=> "objet",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 		=> [
				new VideValidator("Objet obligatoire")
			]
		]));

		$this->add(new TextArea([
			"label" 				=> "Votre message ",
			"name" 					=> "message",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 		=> [
				new VideValidator("Message obligatoire")
			]
		]));

		$this->add(new InputSubmit([
			"name" 					=> "go",
			"cssChamp" 			=> "btn",
			"value" 				=> "Envoyer"
		]));


		return $this;

	}

}