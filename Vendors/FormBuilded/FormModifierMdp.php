<?php
namespace Vendors\FormBuilded;
use OCFram\HTTPRequest;

use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputPassword;
use Vendors\FormBuilder\Link;
use Vendors\FormBuilder\InputSubmit;

use Vendors\Validator\VideValidator;
use Vendors\Validator\MinLengthValidator;
use Vendors\Validator\MajusculeValidator;
use Vendors\Validator\MinusculeValidator;
use Vendors\Validator\ChiffreValidator;
use Vendors\Validator\SpecialCharValidator;
use Vendors\Validator\NotEgalValidator;


class FormModifierMdp extends Form {
	//Pour modifier mot de passe

	function buildForm(){

		$http = new HTTPRequest();

		$this->add(new InputPassword([
			"label"	 		=> "Mot de passe actuel : ",
			"name"	 		=> "pass_user1",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 	=> [
				new VideValidator("Votre actuel mot de passe est nécessaire pour autoriser la modification")
			]
		]));
		
		$this->add(new InputPassword([
			"label"	 		=> "Nouveau mot de passe : ",
			"name"	 		=> "pass_user2",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 	=> [
				new NotEgalValidator("Votre nouveau mot de passe ne doit pas être identique à l'ancien",$http->getDataPost("pass_user1")),
				new MajusculeValidator("Au moins une majuscule"),
				new MinusculeValidator("Au moins une minuscule"),
				new ChiffreValidator("Au moins un chiffre"),
				new SpecialCharValidator("Au moins un caractère spécial"),
				new MinLengthValidator("8 caractères minimum",8)
			]
		]));

		/*$this->add(new Link([
			"href"		=> "javascript:void(0)",
			"title"		=> "Vérifiez votre saisie",
			"id"		=> "confirmPass",
			"label"		=> "Affichez le mot de passe"
		]));*/

		$this->add(new InputSubmit([
			"name"	 => "go",
			"value"	 => "Modifier",
			"cssChamp"	 => "btn"
		]));
		
		return $this;

	}
}
