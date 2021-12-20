<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputDate;

use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\DateValidator;
use Vendors\Validator\TimeValidator;

use Vendors\Validator\VideValidator;
use Vendors\Validator\PoidsValidator;
use Vendors\Validator\NumberValidator;

class FormBaby extends Form {
    
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

            

        $this->add(new InputDate([
            "label" 				=> "Date de naissance",
            "name" 					=> "date_naissance_baby",
            "placeholder"       	=> "2019-05-18",
            "id"                    => "dateOrder",
            "cssLabel" 		    	=> "consigne",
            "cssChamp" 		    	=> "champ",
            "getterEntity"          => "getDateNaissanceBaby",
            "validators" 	        => [
                new DateValidator("Choisissez une date valide"),
                new VideValidator("La date de naissance est obligatoire")
                
                ]
                ]));
                    
                    
        $this->add(new InputText([
            "label" 			=> "Heure de naissance",
            "name" 				=> "heure_naissance_baby",
            "placeholder"   	=> "23:23:00",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 		=> [
                new TimeValidator("L'heure de naissance doit être valide"),
                new VideValidator("L'heure de naissance est obligatoire")
            ],
                "getterEntity"      => "getHeureNaissanceBaby"
                ]));


        $this->add(new InputText([
            "label" 			=> "Lieu de naissance",
            "name" 				=> "lieu_naissance_baby",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 		=> [
                new VideValidator("Le lieu de naissance est obligatoire")
            ],
            "getterEntity"      => "getLieuNaissanceBaby"
                ]));


        $this->add(new InputText([
            "label" 			=> "Poids de naissance \"2.230\"(kg)",
            "name" 				=> "poids_naissance_baby",
            "placeholder"       	=> "3.130",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ",
            "validators" 		=> [
                new NumberValidator("Le poids doit être numérique"),
                new PoidsValidator("Le poids ne doit pas être négatif et cohérant avec un poids de naissance"),

                new VideValidator("Le poids de naissance est obligatoire")
            ],
                "getterEntity"      => "getPoidsNaissanceBaby"
                ]));


        $this->add(new InputText([
            "label" 			=> "Taille de naissance (cm)",
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
