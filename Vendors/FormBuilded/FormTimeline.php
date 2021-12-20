<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputDate;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\VideValidator;
use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadTypeValidator;
use Vendors\Validator\UploadMaxSizeValidator;

class FormTimeline extends Form {
    
    function buildForm(){
        $http = new HTTPRequest();


        $this->add(new InputDate([
            "label" 				=> "Date de la photo",
            "name" 					=> "date_timeline",
            "placeholder"       	=> "2019-05-18",
            "id"                    => "dateOrder",
            "cssLabel" 		    	=> "consigne",
            "cssChamp" 		    	=> "champ",
            "validators" 	        => [
                new DateValidator("Choisissez une date inférieur ou égale à aujourd'hui"),
                new VideValidator("La date de naissance est obligatoire")
                
                ]
                ]));

        $this->add(new InputFile([
            "label" 		    => "Choisissez la photo",
            "name" 			    => "nom_photo_timeline",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 	    => [
                new UploadTypeValidator(
                    "Veuillez choisir un format jpg ou png",
                    $http->getDataFiles("nom_photo_timeline","type"),
                    ["image/jpeg","image/png"]
                ),
                new UploadMaxSizeValidator(
					"Sélectionnez un fichier inférieur à 512 Mo",
					$http->getDataFiles("photo_baby","size")
				),
                new UploadCodeValidator(
                    "Upload impossible",
                    $http->getDataFiles("nom_photo_timeline","error")
                    )
                    
                ]
        
        ]));
            

                    

		$this->add(new InputSubmit([
			"name" 			=> "timeline",
			"cssChamp" 		=> "slide-hover-left",
			"value" 		=> "Enregistrer"
		]));


		return $this;
	}
}
