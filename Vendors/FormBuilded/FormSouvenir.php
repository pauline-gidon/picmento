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



class FormSouvenir extends Form {

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

        $this->add(new InputFile([
			"label" 		=> "Votre 1er photo : ",
			"name" 			=> "photo1",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ"
		]));
        $this->add(new InputFile([
			"label" 		=> "Votre 2ème photo : ",
			"name" 			=> "photo2",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ"
		]));

        $this->add(new InputFile([
			"label" 		=> "Votre 3ème photo : ",
			"name" 			=> "photo3",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ"
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