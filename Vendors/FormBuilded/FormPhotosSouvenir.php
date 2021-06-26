<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputFile2;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadTypeValidator;
use Vendors\Validator\UploadMaxSizeValidator;

class FormPhotosSouvenir extends Form {
    
    function buildForm(){
		$http = new HTTPRequest();

        if(isset($_SESSION["nom_photo1"])){
            $this->add(new Inputfile([
                "label" 		    => "Photo 1 enregistrée ✔️",
                "name" 			    => "photo1",
                "cssLabel" 			=> "consigne",
                "cssChamp" 			=> "champ"
                ]));
            }else{
                $this->add(new InputFile([
            "label" 		    => "Choisissez une photo",
            "name" 			    => "photo1",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ"
                
             ]));
        }  // fin du if photo1

        if(isset($_SESSION["nom_photo2"])){
            $this->add(new Inputfile([
                "label" 		    => "Photo 2 enregistrée ✔️",
                "name" 			    => "photo2",
                "cssLabel" 			=> "consigne",
                "cssChamp" 			=> "champ"
                ]));
            }else{
                $this->add(new InputFile([
            "label" 		    => "Choisissez une photo",
            "name" 			    => "photo2",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ"
            
             ]));
        }  // fin du if photo2

        if(isset($_SESSION["nom_photo3"])){
            $this->add(new Inputfile([
                "label" 		    => "Photo 3 enregistrée ✔️",
                "name" 			    => "photo3",
                "cssLabel" 			=> "consigne",
                "cssChamp" 			=> "champ"
                ]));
            }else{
                $this->add(new InputFile([
            "label" 		    => "Choisissez une photo",
            "name" 			    => "photo3",
            "cssLabel" 			=> "consigne",
            "cssChamp" 			=> "champ"
                    
             ]));
        }  // fin du if photo3
            

                    

		$this->add(new InputSubmit([
			"name" 			=> "go",
			"cssChamp" 		=> "slide-hover-left",
			"value" 		=> "Enregistrer"
		]));



		return $this;
	}
}
