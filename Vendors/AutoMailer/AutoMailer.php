<?php
namespace Vendors\AutoMailer;

class AutoMailer {
	private $expediteur;
	private $destinataire;
	private $objet;
	private $message;
	private $replyTo;


	function __construct($desti,$obj,$msg,$replyTo="no-reply@picmento.fr",$expe="no-reply@picmento.fr"){
		$this->expediteur 	= $expe;
		$this->destinataire = $desti;
		$this->objet 				= $obj;
		$this->message 			= $msg;
		$this->replyTo 			= $replyTo;
	}

	function sendMail(){
		$entetes 	=	"From:".$this->expediteur."\n";
		$entetes 	.=	"Reply-To:".$this->replyTo."\n";
		//$entetes 	.=	"Cc:".$this->copies."\n";
		//$entetes 	.=	"Bcc:".$this->copiesCachees."\n";
		$entetes 	.=	"MIME-Version: 1.0\r\n";
		$entetes 	.=	"Content-Type: text/html; charset=utf-8\r\n";
		$entetes 	.=	"Content-Transfert-Encoding: 8bit\r\n";
		$entetes 	.=	"Object:".$this->objet;

		return (mail($this->destinataire,$this->objet,$this->message,$entetes));

	}
}

