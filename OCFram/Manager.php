<?php
namespace OCFram;
use OCFram\Connexion;

class Manager {
	protected $db;

	function __construct(Connexion $cx){
		$this->db = $cx;
	}


}
