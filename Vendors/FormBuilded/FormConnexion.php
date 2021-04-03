<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputPassword;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\Link;

use Vendors\Validator\EmailValidator;
use Vendors\Validator\VideValidator;

class FormConnexion extends Form {

	function buildForm(){

		$this->add(new InputEmail([
			"label" 				=> "Votre&nbsp;identifiant ",
			"placeholder" 	=> "ophelie@gmail.com",
			"name" 					=> "email_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 		=> [
				new EmailValidator("Email obligatoire")
			]
		]));

		$this->add(new InputPassword([
			"label" 				=> "Votre&nbsp;mot&nbsp;de&nbsp;passe ",
			"name" 					=> "pass_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ ",
			"validators" 		=> [
				new VideValidator("Mot de passe obligatoire")
			]
		]));

		$this->add(new InputSubmit([
			"name" 					=> "connexion",
			"cssChamp" 			=> "btn",
			"value" 				=> "Se connecter"
		]));

		$this->add(new Link([
			"label"			=> "Mot de passe oublié",
			"href" 			=> "mot-passe-oublie",
			"id" 			=> "passe-oublie",
			"title" 		=> "Réinitialiser votre mot de passe"
		]));


		return $this;

	}

}