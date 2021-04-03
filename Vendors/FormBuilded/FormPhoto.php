<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\InputFile;

class FormPhoto extends Form {
    
    function buildForm(){

        $this->add(new InputFile([
            "label" 		    => "Choisissez une nouvelle photo : ",
            "name" 			    => "nom_photo",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ"
        ]));
            

                    

		$this->add(new InputSubmit([
			"name" 			=> "addPhoto",
			"cssChamp" 		=> "btn",
			"value" 		=> "Enregistrer"
		]));


		return $this;
	}
}
