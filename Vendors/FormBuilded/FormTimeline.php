<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\MonthValidator;
use Vendors\Validator\VideValidator;
use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadTypeValidator;
use Vendors\Validator\UploadMaxSizeValidator;
use Vendors\Validator\YearValidator;

class FormTimeline extends Form {
    
    function buildForm(){
        $http = new HTTPRequest();


        $this->add(new InputText([
            "label" 			=> "Année",
			"name" 				=> "annee_photo_timeline",
            "placeholder"       => "2021",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getAnneePhotoTimeline",
			"validators" 		=> [
                new VideValidator("L'année est obligatoire"),
                new YearValidator("L'année ne peut pas être supérieur à l'année actuelle")
                ]
        ]));
        $this->add(new InputText([
            "label" 			=> "Mois",
			"name" 				=> "mois_photo_timeline",
            "placeholder"       	=> "01 => 12",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getMoisPhotoTimeline",
			"validators" 		=> [
                new VideValidator("Le mois est obligatoire"),
                new MonthValidator("Le mois ne doit pas être inférieur à 01 et supérieur à 12")
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
