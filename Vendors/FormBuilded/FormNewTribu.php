<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\InputText;

use Vendors\Validator\VideValidator;


class FormNewTribu extends Form {

	function buildForm(){

		$this->add(new InputText([
			"label" 				=> "Le nom de ma tribu : ",
			"name" 					=> "nom_tribu",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 		=> [
				new VideValidator("Nom tribu obligatoire")
			]
		]));


		$this->add(new InputSubmit([
			"name" 			=> "addtribu",
			"cssChamp" 			=> "btn",
			"value" 		=> "Ajouter"
		]));


		return $this;
	}
}
