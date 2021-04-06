<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputRadio;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\VideValidator;



class FormCommentaire extends Form {

	function buildForm(){

		$this->add(new TextArea([
			"label" 			=> "Votre Commentaire : ",
			"name"				=> "description_commentaire",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getDescriptionCommentaire",
			"validators" 		=> [
				new VideValidator("Votre commentaire ne peut pas être vide")
			]
		]));



		$this->add(new InputSubmit([
		"name" 					=> "go",
		"cssChamp" 				=> "btn",
		"value" 				=> "Enregistrer"
		]));


		return $this;

	}

}