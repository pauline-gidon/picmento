<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\InputRadio;




class FormAnnul extends Form {

	function buildForm(){



		$this->add(new InputRadio([
			"label" 		=> "Oui",
			"value" 		=> 1,
			"name" 			=> "annule",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ"
		]));
		$this->add(new InputRadio([
			// "checked"		=>TRUE,
			"label" 		=> "Non",
			"value"			=> 0,
			"name" 			=> "annule",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ"
		]));


		$this->add(new InputSubmit([
		"name" 					=> "annuler",
		"cssChamp" 				=> "btn",
		"value" 				=> "Enregistrer"
		]));


		return $this;

	}

}