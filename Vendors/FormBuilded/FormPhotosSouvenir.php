<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadTypeValidator;
use Vendors\Validator\UploadMaxSizeValidator;

class FormPhotosSouvenir extends Form {
    
    function buildForm(){
		$http = new HTTPRequest();

        $this->add(new InputFile([
            "label" 		    => "Choisissez une photo : ",
            "name" 			    => "photo",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 	=> [
				new UploadTypeValidator(
					"Veuillez choisir un format jpg ou png",
					$http->getDataFiles("photo","type"),
					["image/jpeg","image/png"]
				),
				new UploadMaxSizeValidator(
					"Sélectionnez un fichier inférieur à 2 Mo",
					$http->getDataFiles("photo","size")
				),
				new UploadCodeValidator(
					"Upload impossible",
					$http->getDataFiles("photo","error")
				)
			]
        ]));
            

                    

		$this->add(new InputSubmit([
			"name" 			=> "go",
			"cssChamp" 		=> "btn",
			"value" 		=> "Enregistrer"
		]));

		$this->add(new InputSubmit([
			"name" 			=> "addPhoto",
			"cssChamp" 		=> "btn",
			"value" 		=> "Ajouter une autre photo"
		]));


		return $this;
	}
}
