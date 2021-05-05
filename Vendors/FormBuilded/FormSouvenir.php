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



class FormSouvenir extends Form {

	function buildForm(){
		$http = new HTTPRequest();
       
		$this->add(new InputText([
			"label" 				=> "Le titre",
			"name" 					=> "titre_article",
			"cssLabel" 				=> "consigne",
			"cssChamp" 				=> "champ",
			"getterEntity"      	=> "getTitreArticle",
			"validators" 			=> [
				new VideValidator("Titre obligatoire")
			]
		]));

		$this->add(new TextArea([
			"label" 			=> "Description du souvenir",
			"name"				=> "description_article",
			"cssLabel" 			=> "consigne",
            "security"          => 2,
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getDescriptionArticle",
			"validators" 		=> [
				new VideValidator("Description obligatoire")
			]
		]));

		$this->add(new InputDate([
			"label" 		=> "Date du souvenir",
			"name" 			=> "date_article",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ",
			"validators"	=> [
				new DateValidator(
					"Choisissez une date inférieur ou égale à aujourd'hui"
                ),
				new VideValidator("Date obligatoire")

			],
			"getterEntity" => "getDateArticle"
		]));



        $this->add(new InputRadio([
            // "checked"		=>TRUE,
            "label" 		=> "Public",
            "value"			=> 1,
            "name" 			=> "actif_article",
            "cssLabel" 		=> "consigne",
            "cssChamp" 		=> "champ",
            "getterEntity" 	=> "getActifArticle",
            "selected"      => TRUE
        ]));
		$this->add(new InputRadio([
			"label" 		=> "Privé (visible uniquement par le(s) parent(s) )",
			"value" 		=> 0,
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

		$this->add(new InputSubmit([
		"name" 					=> "addPhoto",
		"cssChamp" 				=> "btn",
		"value" 				=> "Ajouter une photo"
		]));


		return $this;

	}

}