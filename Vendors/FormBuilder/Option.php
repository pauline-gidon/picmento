<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class Option extends Field {
	
	function getWidget(){
		$widget	= "<option ";
		$widget	.= isset($this->value)?" value=\"".$this->value."\"":NULL;
		$widget	.= ($this->selected === TRUE)?" selected":NULL;
		$widget	.= ">";
		$widget	.= isset($this->label)?$this->label:NULL;
		$widget	.= "</option>";
		
		return $widget;
	}

}
