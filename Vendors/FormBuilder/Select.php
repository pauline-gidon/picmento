<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;

class Select extends Field {
	//Attributs supplémentaires à la classe Field
	protected $options = [];

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;


		$widget = isset($this->label)?"<label for=\"$id\" ":NULL;
		$widget .= isset($this->cssLabel)?" class=\"".$this->cssLabel."\"":NULL;
		$widget .= isset($this->label)?">".$this->label."</label>":NULL;
		
		$widget	.= $this->errorMessage;	
				
		$widget	.= "<select";
		$widget	.= isset($this->name)?" name=\"".$this->name."\"":NULL;
		$widget .= " id=\"$id\"";
		$widget	.= isset($this->cssChamp)?" class=\"".$this->cssChamp."\"":NULL;
		$widget	.= ">";

		$widget	.= "<option value=\"ras\">Sélectionnez</option>";

		foreach($this->options as $option){
			$widget	.= $option->getWidget();
		}

		$widget	.= "</select>";


				
		return $widget;
	}

	function getOptions(){
		return $this->options;
	}

}
