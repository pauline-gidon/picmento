<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputSubmit;



class FormSignalement extends Form {

	function buildForm(){
		$http = new HTTPRequest();
       
		$this->add(new TextArea([
			"label" 				=> "Votre message",
			"name" 					=> "text_signalement",
            "placeholder"           => "Merci de rensigner la nature du signalement",
			"cssLabel" 				=> "consigne",
			"cssChamp" 				=> "champ",
	
		]));

		$this->add(new InputSubmit([
		"name" 					=> "go",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Envoyer"
		]));
		$this->add(new InputSubmit([
		"name" 					=> "annuler",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Annuler"
		]));


		return $this;

	}

}