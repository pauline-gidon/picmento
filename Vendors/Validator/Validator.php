<?php
namespace Vendors\Validator;

class Validator {
	protected $error;

	function __construct($message){
		$this->error = $message;
	}

	function getError() {
		return "<span class=\"alerte\">".$this->error."</span>";
	}
	
}
