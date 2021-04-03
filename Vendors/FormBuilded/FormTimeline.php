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

class FormTimeline extends Form {
    
    function buildForm(){
        $http = new HTTPRequest();


        $this->add(new InputText([
            "label" 			=> "Année : ",
			"name" 				=> "annee_photo_timeline",
            "placeholder"       	=> "2021",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getAnneePhotoTimeline",
			"validators" 		=> [
                new VideValidator("L'année est obligatoire")
                ]
        ]));
        $this->add(new InputText([
            "label" 			=> "Mois : ",
			"name" 				=> "mois_photo_timeline",
            "placeholder"       	=> "00, 05 ou 10 ...",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getMoisPhotoTimeline",
			"validators" 		=> [
                new VideValidator("Le mois est obligatoire"),
                new MonthValidator("Le mois ne doit pas être supérieur à 12")
                ]
        ]));

        $this->add(new InputFile([
            "label" 		    => "Choisissez la photo : ",
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
                    "Sélectionnez un fichier inférieur à 2 Mo",
                    $http->getDataFiles("nom_photo_timeline","size")
                ),
                new UploadCodeValidator(
                    "Upload impossible",
                    $http->getDataFiles("nom_photo_timeline","error")
                    )
                ]
        
        ]));
            

                    

		$this->add(new InputSubmit([
			"name" 			=> "timeline",
			"cssChamp" 		=> "btn",
			"value" 		=> "Enregistrer"
		]));


		return $this;
	}
}
