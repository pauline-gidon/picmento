<?php
namespace OCFram;
trait Hydrator {
	function hydrate(Array $datas){
		foreach($datas as $key => $value) {
			$this->$key = $value;
		}
	}
}