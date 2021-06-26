<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputPassword;
use Vendors\FormBuilder\InputSubmit;

use Vendors\Validator\MinLengthValidator;
use Vendors\Validator\MajusculeValidator;
use Vendors\Validator\MinusculeValidator;
use Vendors\Validator\ChiffreValidator;
use Vendors\Validator\SpecialCharValidator;


class FormMdp extends Form {
	//Pour mot de passe oublié

	function buildForm(){
		
		$this->add(new InputPassword([
			"label"	 		=> "Mot de passe",
			"name"	 		=> "pass_user",
			"placeholder" 	=> "8 caractères, minuscule, majuscule, chiffre, 
							caractère spécial",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 	=> [
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
			"value"	 => "Réinitialiser",
			"cssChamp"	 => "slide-hover-left"
		]));
		
		return $this;

	}
}
