<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\VideValidator;



class FormMessage extends Form {

	function buildForm(){
		$http = new HTTPRequest();
       
		$this->add(new TextArea([
			"label" 				=> "Votre message",
			"name" 					=> "text_message",
			"cssLabel" 				=> "consigne",
			"cssChamp" 				=> "champ",
			"validators" 			=> [
				new VideValidator("Message obligatoire")
			]
		]));

		$this->add(new InputSubmit([
		"name" 					=> "go",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Envoyer"
		]));


		return $this;

	}

}