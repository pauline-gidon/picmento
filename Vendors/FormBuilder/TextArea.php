<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class TextArea extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;


		$widget = $this->errorMessage;
		$widget .= isset($this->label)?"<label for=\"$id\" ":NULL;
		$widget .= isset($this->cssLabel)?" class=\"".$this->cssLabel."\"":NULL;
		$widget .= isset($this->label)?">".$this->label."</label>":NULL;


		$widget .= "<textarea";

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->cssChamp)?" class=\"".$this->cssChamp."\"":NULL;
		$widget .= isset($this->placeholder)
		?" placeholder=\"".$this->placeholder."\"":NULL;
		$widget .= " cols=\"30\" rows=\"10\"";
			
		$widget .= ">";

		$widget .= isset($this->value)?$this->value:NULL;

		$widget .= "</textarea>";



		return $widget;
	}

}

