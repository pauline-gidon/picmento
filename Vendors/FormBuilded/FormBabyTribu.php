<?php
namespace Vendors\FormBuilded;

use NumberFormatter;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputDate;
use Vendors\FormBuilder\InputFile;

use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\TimeValidator;
use Vendors\Validator\VideValidator;
use Vendors\Validator\PoidsValidator;
use Vendors\Validator\NumberValidator;

use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadTypeValidator;
use Vendors\Validator\UploadMaxSizeValidator;

class FormBabyTribu extends Form {
    
    function buildForm(){
        $http = new HTTPRequest();
        
        
		$this->add(new InputText([
            "label" 			=> "Nom d'enfant&nbsp;: ",
			"name" 				=> "nom_baby",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getNomBaby",
			"validators" 		=> [
                new VideValidator("Nom Enfant obligatoire")
                ]
                ]));
                

        $this->add(new InputFile([
            "label" 		    => "Choisissez sa photo&nbsp;: ",
            "name" 			    => "photo_baby",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 	    => [
        new UploadTypeValidator(
            "Veuillez choisir un format jpg ou png",
            $http->getDataFiles("photo_baby","type"),
            ["image/jpeg","image/png"]
        ),
        new UploadMaxSizeValidator(
            "Sélectionnez un fichier inférieur à 2 Mo",
            $http->getDataFiles("photo_baby","size")
        ),
        new UploadCodeValidator(
            "Upload impossible",
            $http->getDataFiles("photo_baby","error")
            )
        ],
        "getterEntity"      => ""

 
        ]));
            

        $this->add(new InputDate([
            "label" 				=> "Date de naissance&nbsp;: ",
            "name" 					=> "date_naissance_baby",
            "placeholder"       	=> "2019-05-18",
            "cssLabel" 		    	=> "consigne",
            "cssChamp" 		    	=> "champ",
            "getterEntity"          => "getDateNaissanceBaby",
            "validators" 	        => [
                new DateValidator("La date de naissance est obligatoire et doit être inférieur ou egale à aujourd'hui")
                
                ]
                ]));
                    
                    
        $this->add(new InputText([
            "label" 			=> "Heure de naissance&nbsp;: ",
            "name" 				=> "heure_naissance_baby",
            "placeholder"   	=> "15:23:00",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 		=> [
                new TimeValidator("L'heure de naissance est obligatoire")
            ],
                "getterEntity"      => "getHeureNaissanceBaby"
                ]));


        $this->add(new InputText([
            "label" 			=> "Lieu de naissance&nbsp;: ",
            "name" 				=> "lieu_naissance_baby",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 		=> [
                new VideValidator("Le lieu de naissance est obligatoire")
            ],
            "getterEntity"      => "getLieuNaissanceBaby"
                ]));


        $this->add(new InputText([
            "label" 			=> "Poids de naissance \"kg\"&nbsp;: ",
            "name" 				=> "poids_naissance_baby",
            "placeholder"       	=> "3.130",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 		=> [
                new PoidsValidator("Le poids ne doit pas être négatif et cohérant avec un poids de naissance"),
                new VideValidator("Le poids de naissance est obligatoire"),
                new NumberValidator("Le poids doit être numérique")
            ],
                "getterEntity"      => "getPoidsNaissanceBaby"
                ]));


        $this->add(new InputText([
            "label" 			=> "Taille de naissance \"cm\"&nbsp;: ",
            "name" 				=> "taille_naissance_baby",
            "placeholder"       	=> "50",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "getterEntity"      => "getTailleNaissanceBaby",
            "validators" 		=> [
                new NumberValidator("La taille doit être numérique"),
                new VideValidator("La taille de naissance est obligatoire")
                ]
                ]));

                    //		poids_naissance_baby 	taille_naissance_baby 	tribu_id_tribu 	
                    

		$this->add(new InputSubmit([
			"name" 			=> "addbaby",
			"cssChamp" 		=> "btn",
			"value" 		=> "Enregistrer"
		]));


		return $this;
	}
}
