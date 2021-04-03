<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputRadio;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\VideValidator;



class FormEditeSouvenir extends Form {

	function buildForm(){
		$http = new HTTPRequest();

		$this->add(new InputText([
			"label" 				=> "Le titre : ",
			"name" 					=> "titre_article",
			"cssLabel" 				=> "consigne",
			"cssChamp" 				=> "champ",
			"getterEntity"      	=> "getTitreArticle",
			"validators" 			=> [
				new VideValidator("Titre obligatoire")
			]
		]));

		$this->add(new TextArea([
			"label" 			=> "Description du souvenir : ",
			"name"				=> "description_article",
			"cssLabel" 			=> "consigne",
            "security"          => 2,
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getDescriptionArticle",
			"validators" 		=> [
				new VideValidator("Description obligatoire")
			]
		]));

		$this->add(new InputText([
			"label" 		=> "Date du souvenir : ",
			"name" 			=> "date_article",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ",
			"validators"	=> [
				new DateValidator(
					"Choisissez une date valide"
				)
			],
			"getterEntity" => "getDateArticle"
		]));


		$this->add(new InputRadio([
			"label" 		=> "Privé (visible uniquement pour moi ",
			"value" 		=> 0,
			"name" 			=> "actif_article",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ",
			"getterEntity" 	=> "getActifArticle"
		]));
		$this->add(new InputRadio([
			// "checked"		=>TRUE,
			"label" 		=> "Public",
			"value"			=> 1,
			"name" 			=> "actif_article",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ",
			"getterEntity" 	=> "getActifArticle"
		]));


		$this->add(new InputSubmit([
		"name" 					=> "souvenir",
		"cssChamp" 				=> "btn",
		"value" 				=> "Enregistrer"
		]));


		return $this;

	}

}