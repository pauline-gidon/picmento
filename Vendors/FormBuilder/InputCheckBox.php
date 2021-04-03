<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputCheckBox extends Field {

	function getWidget(){
		
		$id = (isset($this->id))?$this->id:$this->name;

		$widget = $this->errorMessage;

		$widget .= "<input type=\"checkbox\"";
		
		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->cssChamp)?" class=\"".$this->cssChamp."\"":NULL;
		$widget .= isset($this->value)?" value=\"".$this->value."\"":NULL;
		$widget .= ($this->selected === TRUE)?" checked":NULL;

		$widget .= ">";

		$widget .= isset($this->label)?"<label for=\"$id\" ":NULL;
		$widget .= isset($this->cssLabel)?" class=\"".$this->cssLabel."\"":NULL;
		$widget .= isset($this->label)?">".$this->label."</label>":NULL;

		
		return $widget;
	}

}

