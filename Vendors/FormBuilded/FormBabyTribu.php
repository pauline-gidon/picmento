<?php
namespace Vendors\FormBuilded;

use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputDate;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputFile2;

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
            "label" 			=> "Nom d'enfant",
			"name" 				=> "nom_baby",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"getterEntity"      => "getNomBaby",
			"validators" 		=> [
        new VideValidator("Nom Enfant obligatoire")
        ]
        ]));
        //si premiere submit ou photo déja enregister
        // var_dump($_FILES["photo_baby"]);
        // var_dump($_SESSION["nom_photo_baby"]);
        if(isset($_SESSION["nom_photo_baby"])){
                $this->add(new Inputfile2([
                    "label" 		    => "Photo enregistrée ✔️",
                    "name" 			    => "photo_baby",
                    "cssLabel" 			=> "consigne",
                    "cssChamp" 			=> "champ"
                    ]));
                }else{
                    $this->add(new InputFile([
                "label" 		    => "Choisissez sa photo",
                "name" 			    => "photo_baby",
                "cssLabel" 			=> "consigne",
                "cssChamp" 			=> "champ",
                "validators" 		=> [
                    new UploadTypeValidator(
                        "Veuillez choisir un format jpg ou png",
                        $http->getDataFiles("photo_baby","type"),
                        ["image/jpeg","image/png","image/jpg"]
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
        }

        $this->add(new InputDate([
            "label" 				=> "Date de naissance",
            "name" 					=> "date_naissance_baby",
            "placeholder"       	=> "2019-05-18",
            "cssLabel" 		    	=> "consigne",
            "id"                    => "dateOrder",
            "cssChamp" 		    	=> "champ",
            "getterEntity"          => "getDateNaissanceBaby",
            "validators" 	        => [
        new DateValidator("La date de naissance est obligatoire et doit être inférieur ou egale à aujourd'hui")
        
        ]
        ]));
                    
                    
        $this->add(new InputText([
            "label" 			=> "Heure de naissance",
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
            "label" 			=> "Ville de naissance",
            "name" 				=> "lieu_naissance_baby",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 		=> [
        new VideValidator("Le lieu de naissance est obligatoire")
            ],
            "getterEntity"      => "getLieuNaissanceBaby"
        ]));


        $this->add(new InputText([
            "label" 			=> "Poids de naissance (kg)",
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
            "label" 			=> "Taille de naissance ( cm )",
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
			"cssChamp" 		=> "slide-hover-left",
			"value" 		=> "Enregistrer"
		]));


		return $this;
	}
}
