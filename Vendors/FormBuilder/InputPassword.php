<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputPassword extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;

		$widget = $this->errorMessage;
		$widget .= isset($this->label)?"<label for=\"$id\" ":NULL;
		$widget .= isset($this->cssLabel)?" class=\"".$this->cssLabel."\"":NULL;
		$widget .= isset($this->label)?">".$this->label."</label>":NULL;


		$widget .= "<input type=\"password\"";
        
        $widget .= isset($this->placeholder)
		?" placeholder=\"".$this->placeholder."\"":NULL;

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->cssChamp)?" class=\"".$this->cssChamp."\"":NULL;
		$widget .= isset($this->value)?" value=\"".$this->value."\"":NULL;

		$widget .= ">";


		return $widget;
	}

}

