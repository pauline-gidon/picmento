<?php
namespace Vendors\FormBuilder;
use Vendors\FormBuilder\Field;


class Link extends Field {
	//Attributs supplémentaires à la classe Field
	protected $href;
	protected $title;
	protected $target;

	function getWidget(){

		$id = (isset($this->id))?$this->id:$this->name;

		$widget 	= "<a";
		$widget 	.= isset($this->href)?" href=\"".$this->href."\"":NULL;
		$widget 	.= isset($this->title)?" title=\"".$this->title."\"":NULL;
		$widget 	.= isset($this->target)?" target=\"".$this->target."\"":NULL;
		$widget 	.= " id=\"$id\"";
		$widget 	.= isset($this->cssChamp)?" class=\"".$this->cssChamp."\"":NULL;		
		$widget 	.= ">";

		$widget 	.= isset($this->label)?$this->label:NULL;

		$widget 	.= "</a>";		 

		return $widget;
	}

}

