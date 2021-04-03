<?php
namespace ORM\Signalement\Entity;
use OCFram\Hydrator;
class Signalement {
	use Hydrator;	
	private $id_signalement;
	private $text_signalement;
	private $date_signalement;
	private $user_id_user;
	private $article_id_article;
	private $commentaire_id_commentaire;
	private $medias_id_medias;


	function __construct(Array $datas){
		$this->hydrate($datas);
	}

	//GETTERS
	function getIdSignalemen(){
		return $this->id_signalement;
	}
	function getTextSignalement(){
		return $this->text_signalement;
	}
	function getDateSignalement(){
		return $this->date_signalement;
	}
	function getUserIdUser(){
		return $this->user_id_user;
	}
	function getArticleIdArticle(){
		return $this->article_id_article;
	}
	function getCommentaireIdCommentaire(){
		return $this->commentaire_id_commentaire;
	}
	function getMediasIdMedias(){
		return $this->medias_id_medias;
	}



	//SETTERS
	
	function setTextSignalement($val){
		$this->text_signalement = $val;
	}
	function setDateSignalement($val){
		$this->date_signalement = $val;
	}
	function setUserIdUser($val){
		$this->user_id_user = $val;
	}
	function setArticleIdArticle($val){
		$this->article_id_article = $val;
	}
	function setCommentaireIdCommentaire($val){
		$this->commentaire_id_commentaire = $val;
	}
	function setMediasIdMedias($val){
		$this->medias_id_medias = $val;
	}




}
