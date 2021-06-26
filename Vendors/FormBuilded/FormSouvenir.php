<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\Option;
use Vendors\FormBuilder\Select;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputDate;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\VideValidator;
use Vendors\Validator\SelectValidator;



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
            "id"            => "dateOrder",
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



        $this->add(new Select([
            "label" 		=> "Visibilité de ce souvenir",
            "name" 			=> "actif_article",
            "cssLabel" 		=> "consigne",
            "cssChamp" 		=> "champ",
            "getterEntity" 	=> "getActifArticle",
            "options"        => [ 
                new Option([
                    "label" => "Public",
                    "value" => 1,
                    "selected" => TRUE
                ]),
                new Option([
                    "label" => "Privé",
                    "value" => 0
                ])
            
                ],
            "validators" => [
                new SelectValidator("Veuillez choisir la visibilité du souvenir")
            ]
        ]));


		$this->add(new InputSubmit([
		"name" 					=> "souvenir",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Enregistrer"
		]));

		$this->add(new InputSubmit([
		"name" 					=> "addPhoto",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Ajouter des photos"
		]));


		return $this;

	}

}
