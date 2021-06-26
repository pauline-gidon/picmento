<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputHidden;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\VideValidator;
use Vendors\Validator\EmailValidator;

class FormContact extends Form {

	function buildForm(){
        
		$this->add(new InputEmail([
			"label" 				=> "Votre email ",
			"placeholder" 	=> "robin@gmail.com",
			"name" 					=> "email",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
            "getterEntity"      	=> "getEmailUser",
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

        $this->add(new InputHidden([
            "name"              => "recaptcha-response",
            "id"                => "recaptchaResponse",
            "validators" 		=> [
				new VideValidator("Erreur spam")
			]
        ]));

		$this->add(new InputSubmit([
			"name" 					=> "go",
			"cssChamp" 			=> "slide-hover-left",
			"value" 				=> "Envoyer"
		]));


		return $this;

	}

}