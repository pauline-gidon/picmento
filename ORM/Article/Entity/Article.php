<?php
namespace ORM\Article\Entity;
use OCFram\Hydrator;

class Article {
	use Hydrator;	
	private $id_article;
	private $titre_article;
	private $description_article;
	private $date_article;
	private $actif_article;
	private $user_id_user;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdArticle(){
		return $this->id_article;
	}
	function getTitreArticle(){
		return $this->titre_article;
	}
	function getDescriptionArticle(){
		return $this->description_article;
	}
	function getDateArticle(){
		return $this->date_article;
	}
	function getActifArticle(){
		return $this->actif_article;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	


	//SETTERS
	
	function setTitreArticle($val){
		$this->titre_article = $val;
	}
	function setDescriptionArticle($val){
		$this->description_article = $val;
	}
	function setDateArticle($val){
		$this->date_article = $val;
	}
	function setActifArticle($val){
		$this->actif_article = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}



}
