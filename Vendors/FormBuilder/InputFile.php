<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class InputFile extends Field {

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;

		$widget = $this->errorMessage;
		$widget .= isset($this->label)?"<label for=\"$id\" ":NULL;
		$widget .= isset($this->cssLabel)?" class=\"".$this->cssLabel."\"":NULL;
		$widget .= isset($this->label)?">".$this->label."</label>":NULL;


		$widget .= "<input type=\"file\"";

		$widget .= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget .= isset($this->cssChamp)?" class=\"".$this->cssChamp."\"":NULL;

		$widget .= ">";


		return $widget;
	}

}

