<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\TextArea;
use Vendors\FormBuilder\InputDate;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\VideValidator;
use Vendors\FormBuilder\InputCheckBox;
use Vendors\Validator\MultipleChoiceValidator;



class FormSouvenirTribuAmis extends Form {

	function buildForm($tableau){
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
            "id"            => "dateOrder",
			"cssChamp" 		=> "champ",
			"validators"	=> [
				new DateValidator(
					"Choisissez une date inférieur ou égale à aujourd'hui"
                ),
				new VideValidator("Date obligatoire")

			],
			"getterEntity" => "getDateArticle"
		]));


        //--------------------------------------------------
		//Une partie du form créée dynamiquement sur la base
		//des babys de la tribu existants dans la BDD
		foreach($tableau as $key => $objet) {
			if($key === 0){
				$this->add(new InputCheckBox([
					"label"		=> $objet->getNomBaby(),
					"value"		=> $objet->getIdBaby(),
					"name"		=> "baby".$objet->getIdBaby(),
					"cssChamp" 	=> "switch",
                    "selected"  => TRUE,
					"validators" => [
						new MultipleChoiceValidator(
							"Vous devez sélectionner au moins une case à cocher",
							"/^baby[0-9]+$/"
						)
                        ],
                        "getterEntity" 	=> "getIdBaby"
				]));
			}else{
				$this->add(new InputCheckBox([
					"label"		=> $objet->getNomBaby(),
					"value"		=> $objet->getIdBaby(),
					"name"		=> "baby".$objet->getIdBaby(),
					"cssChamp" 	=> "switch",
                    "selected"  => TRUE,
    			"getterEntity" 	=> "getIdBaby"

				]));
			}
		}


		$this->add(new InputSubmit([
		"name" 					=> "souvenir",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Envoyer"
		]));

		$this->add(new InputSubmit([
		"name" 					=> "addPhoto",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Ajouter des photos"
		]));


		return $this;

	}

}