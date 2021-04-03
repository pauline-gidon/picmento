<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputSubmit;
use Vendors\FormBuilder\InputFile;


class FormPhotoBaby extends Form {
    
    function buildForm(){

        $this->add(new InputFile([
            "label" 		    => "Choisissez sa nouvelle photo : ",
            "name" 			    => "photo_baby",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "getterEntity"      => "getPhotoBaby"
        ]));
            

                    

		$this->add(new InputSubmit([
			"name" 			=> "addbaby",
			"cssChamp" 		=> "btn",
			"value" 		=> "Enregistrer"
		]));


		return $this;
	}
}
