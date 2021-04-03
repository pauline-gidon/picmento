<?php
namespace Vendors\Validator;
use Vendors\Validator\Validator;

class UploadTypeValidator extends Validator {

	private $type;
	private $types;

	function __construct($message,$type,$types){
		parent::__construct($message);
		$this->type = $type;
		$this->types = $types;
	}


	function isNotValid($saisie) {
		return(!in_array($this->type,$this->types));
	}

}
