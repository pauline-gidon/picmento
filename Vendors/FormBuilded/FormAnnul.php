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
            "id"            => "annule1",
			"name" 			=> "annule",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "switch"
            ]));
            $this->add(new InputRadio([
            "label" 		=> "Non",
            "id"            => "annule2",
            "value"			=> 0,
            "selected"		=> TRUE,
			"name" 			=> "annule",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "switch"
		]));


		$this->add(new InputSubmit([
		"name" 					=> "annuler",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Enregistrer"
		]));


		return $this;

	}

}