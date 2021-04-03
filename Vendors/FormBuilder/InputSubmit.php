<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputSubmit extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;

		$widget = "<input type=\"submit\"";

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->cssChamp)?" class=\"".$this->cssChamp."\"":NULL;
		$widget .= isset($this->value)?" value=\"".$this->value."\"":NULL;

		$widget .= ">";


		return $widget;
	}

}

