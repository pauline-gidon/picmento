<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputHidden extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;

		$widget = "<input type=\"hidden\"";
		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		//$widget .= isset($this->value)?" value=\"".$this->value."\"":NULL;
		$widget .= ">";


		return $widget;
	}

}

?>