<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputDate;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputFile2;
use Vendors\FormBuilder\InputRadio;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\VideValidator;



class FormMessage extends Form {

	function buildForm(){
		$http = new HTTPRequest();
       
		$this->add(new InputText([
			"label" 				=> "Votre Message",
			"name" 					=> "text_message",
			"cssLabel" 				=> "consigne",
			"cssChamp" 				=> "champ",
			"validators" 			=> [
				new VideValidator("Message obligatoire")
			]
		]));

		$this->add(new InputSubmit([
		"name" 					=> "go",
		"cssChamp" 				=> "btn",
		"value" 				=> "Envoyer"
		]));


		return $this;

	}

}