<?php
namespace Vendors\FormBuilded;
use Vendors\FormBuilder\Form;
use Vendors\FormBuilder\InputText;
use Vendors\FormBuilder\InputEmail;
use Vendors\FormBuilder\InputPassword;
use Vendors\FormBuilder\InputCheckBox;
use Vendors\FormBuilder\InputHidden;
use Vendors\FormBuilder\InputSubmit;
use Vendors\Validator\EmailValidator;
use Vendors\Validator\VideValidator;
use Vendors\Validator\MinLengthValidator;
use Vendors\Validator\MinusculeValidator;
use Vendors\Validator\MajusculeValidator;
use Vendors\Validator\ChiffreValidator;
use Vendors\Validator\SpecialCharValidator;
use Vendors\Validator\IssetValidator;

class FormInscription extends Form {

	function buildForm(){

		$this->add(new InputText([
			"label" 				=> "Votre&nbsp;nom ",
			"name" 					=> "nom_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 		=> [
				new VideValidator("Nom obligatoire")
			]
		]));

		$this->add(new InputText([
			"label" 				=> "Votre&nbsp;prénom ",
			"name" 					=> "prenom_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
			"validators" 		=> [
				new VideValidator("Prénom obligatoire")
			]
		]));

		$this->add(new InputEmail([
			"label" 				=> "Votre&nbsp;email ",
			"placeholder" 	=> "Anthea@free.fr",
			"name" 					=> "email_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ",
            "getterEntity"      	=> "getEmailUser",
			"validators" 		=> [
				new EmailValidator("Email obligatoire")
			]
		]));

		$this->add(new InputPassword([
			"label" 				=> "Votre&nbsp;mot&nbsp;de&nbsp;passe ",
			"placeholder" 	=> "8 caractères minimum",
			"name" 					=> "pass_user",
			"cssLabel" 			=> "consigne",
			"cssChamp" 			=> "champ aide-mdp",
			"validators" 		=> [
				new SpecialCharValidator("Un caractère spécial minimum"),
				new ChiffreValidator("Un chiffre minimum"),
				new MajusculeValidator("Une majuscule minimum"),
				new MinusculeValidator("Une minuscule minimum"),
				new MinLengthValidator("8 caractères minimum",8)
			]
		]));

		$this->add(new InputCheckBox([
			"name" 					=> "rgpd_user",
			"value" 				=> 1,
			"label" 				=> " En soumettant ce formulaire, 
			j'accepte la <a href=\"politique-confidentialite\" title=\"Consultez\" target=\"_blank\">politique de confidentialité</a> de&nbsp;Picmento",
			"validators" 		=> [
				new IssetValidator("<span class=\"rgpdAlerte\">Sans votre consentement, nous ne pouvons pas traiter vos données</span>","rgpd_user")
			]
		]));

        $this->add(new InputHidden([
            "name"              => "recaptcha-response",
            "id"                => "recaptchaResponse",
            "validators" 		=> [
				new VideValidator("Erreur spam")
			]
        ]));

		$this->add(new InputSubmit([
			"name" 					=> "inscription",
			"cssChamp" 			=> "slide-hover-left",
			"value" 				=> "S'inscrire"
		]));

      

		return $this;

	}

}