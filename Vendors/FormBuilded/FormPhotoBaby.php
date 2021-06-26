<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadTypeValidator;
use Vendors\Validator\UploadMaxSizeValidator;


class FormPhotoBaby extends Form {
    
    function buildForm(){
		$http = new HTTPRequest();

        $this->add(new InputFile([
            "label" 		    => "Choisissez sa nouvelle photo",
            "name" 			    => "photo_baby",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 	=> [
				new UploadTypeValidator(
					"Veuillez choisir un format jpg ou png",
					$http->getDataFiles("photo_baby","type"),
					["image/jpeg","image/png"]
				),
				new UploadMaxSizeValidator(
					"Sélectionnez un fichier inférieur à 512 Mo",
					$http->getDataFiles("photo_baby","size")
				),
				new UploadCodeValidator(
					"Upload impossible",
					$http->getDataFiles("photo_baby","error")
				)
			]
        ]));
            

                    

		$this->add(new InputSubmit([
			"name" 			=> "addbaby",
			"cssChamp" 		=> "slide-hover-left",
			"value" 		=> "Enregistrer"
		]));


		return $this;
	}
}
