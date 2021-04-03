<?php
namespace ORM\Commentaire\Entity;
use OCFram\Hydrator;

class Commentaire {
	use Hydrator;	
	private $id_commentaire;
	private $description_commentaire;
	private $user_id_user;
	private $article_id_article;



	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdCommentaire(){
		return $this->id_commentaire;
	}
	function getDescriptionCommentaire(){
		return $this->description_commentaire;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getArticleIdArticle(){
		return $this->article_id_article;
	}
	


	//SETTERS
	
	function setDescriptionCommentaire($val){
		$this->description_commentaire = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
	function setArticleIdArticle($val){
		$this->article_id_article = $val;
	}



}
