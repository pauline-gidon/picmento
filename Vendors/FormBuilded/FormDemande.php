<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\InputRadio;




class FormDemande extends Form {

	function buildForm(){



		$this->add(new InputRadio([
            "selected"		=>TRUE,
			"label" 		=> "Accepter",
			"value" 		=> 1,
			"name" 			=> "demande",
            "id"            => "demande1",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "switchDemande"
            ]));
            $this->add(new InputRadio([
            "label" 		=> "Refuser",
            "value"			=> 0,
            "id"            => "demande0",
			"name" 			=> "demande",
			"cssLabel" 		=> "consigne",
			"cssChamp" 		=> "switchDemande"
		]));


		$this->add(new InputSubmit([
		"name" 					=> "go",
		"cssChamp" 				=> "slide-hover-left",
		"value" 				=> "Enregistrer"
		]));


		return $this;

	}

}