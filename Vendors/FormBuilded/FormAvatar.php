<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputFile;
use Vendors\FormBuilder\InputSubmit;

use Vendors\Validator\UploadCodeValidator;
use Vendors\Validator\UploadMaxSizeValidator;
use Vendors\Validator\UploadTypeValidator;

use OCFram\HTTPRequest;


class FormAvatar extends Form {

	function buildForm(){
		$http = new HTTPRequest();

		$this->add(new InputFile([
			"label" 		=> "Choisissez un avatar : ",
			"name" 			=> "avatar_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 	=> [
				new UploadTypeValidator(
					"Veuillez choisir un format jpg ou png",
					$http->getDataFiles("avatar_user","type"),
					["image/jpeg","image/png"]
				),
				new UploadMaxSizeValidator(
					"Sélectionnez un fichier inférieur à 2 Mo",
					$http->getDataFiles("avatar_user","size")
				),
				new UploadCodeValidator(
					"Upload impossible",
					$http->getDataFiles("avatar_user","error")
				)
			]
		]));


		$this->add(new InputSubmit([
			"name" 			=> "go",
			"cssChamp" 			=> "btn",
			"value" 		=> "Charger"
		]));


		return $this;
	}
}

