<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\InputRadio;




class FormDemande extends Form {

	function buildForm(){



		$this->add(new InputRadio([
			"label" 		=> "Accepter",
			"value" 		=> 1,
			"name" 			=> "demande",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ"
		]));
		$this->add(new InputRadio([
			// "checked"		=>TRUE,
			"label" 		=> "Refuser",
			"value"			=> 0,
			"name" 			=> "demande",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "champ"
		]));


		$this->add(new InputSubmit([
		"name" 					=> "go",
		"cssChamp" 				=> "btn",
		"value" 				=> "Enregistrer"
		]));


		return $this;

	}

}