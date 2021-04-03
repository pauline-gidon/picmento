<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\InputText;

use Vendors\Validator\VideValidator;


class FormTribu extends Form {

	function buildForm(){

		$this->add(new InputText([
			"label" 				=> "Le nouveau nom de ma tribu : ",
			"name" 					=> "nom_tribu",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity" => "getNomTribu",
			"validators" 		=> [
				new VideValidator("Nom tribu obligatoire")
			]
		]));


		$this->add(new InputSubmit([
			"name" 			=> "nom-tribu",
			"cssChamp" 			=> "btn",
			"value" 		=> "Modifier"
		]));


		return $this;
	}
}
