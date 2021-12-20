<?php
namespace ORM\Medias\Model;
use OCFram\Manager;
use ORM\Medias\Entity\Medias;

class ManagerMedias extends Manager {

    //----------------------------------------------------------
	//Suppression du medias par son id 
	//----------------------------------------------------------
    function deleteMediasById($id){
        if(is_numeric($id)){
            //si il est supprimer par un signalement je supprimer d'habord le signalement
            $req= "DELETE FROM signalement WHERE medias_id_medias = $id";
            $query = $this->db->query($req);

            // je supprime la relation medias a son article
            $req = "DELETE FROM article_has_medias WHERE medias_id_medias = $id";
            $query = $this->db->query($req);
            
            //je suppirme le media
            $req = "DELETE FROM medias WHERE id_medias = $id";
            $query = $this->db->query($req);
            return ($this->db->affected_rows == 1)?true:false;
        }

    }
    //----------------------------------------------------------
	//insertion medias 
	//----------------------------------------------------------
    function insertMedias(Medias $new_medias){
        $nom_medias  = $this->db->real_escape_string($new_medias->getNomMedias());

        $req 		= "INSERT INTO medias VALUES(
                        NULL,
                        '$nom_medias'
                        )";
      $query 	= $this->db->query($req);
      return $this->db->insert_id;
  }
    //----------------------------------------------------------
	// medias par id
	//----------------------------------------------------------
    function oneMediasById($id){
        if(is_numeric($id)){

            $req 		= "SELECT * FROM medias WHERE id_medias = $id";
            $query = $this->db->query($req);
            return ($query->num_rows == 1)?new Medias($query->fetch_array()):NULL;
        }


  }
  //--------------------------------------------------------
  //Association du medias à son article
  //--------------------------------------------------------
  function insertMediasHasArticle($id_article,$id_medias){
      if((is_numeric($id_article)) && (is_numeric($id_medias))) {
          $req = "
              INSERT INTO article_has_medias 
              VALUES('$id_article','$id_medias')";
          $query = $this->db->query($req);
          return ($this->db->affected_rows == 1)?true:false;
      }
  }
  //--------------------------------------------------------
  //Update medias by id
  //--------------------------------------------------------
  function updateMedias(Medias $medias){
    $nom_medias = $this->db->real_escape_string($medias->getNomMedias());
    $id_medias = $this->db->real_escape_string($medias->getIdMedias());
    if(is_numeric($id_medias)){

        $req = "UPDATE medias 
            SET nom_medias = '$nom_medias'
            WHERE id_medias = $id_medias ";
        $query = $this->db->query($req);
        return ($this->db->affected_rows == 1)?TRUE:FALSE;
    }
  
  }
  //--------------------------------------------------------
  //verif relation id_media et id_article
  //--------------------------------------------------------
  function verifRelationMediaArticle($id_media, $id_article){
    if((is_numeric($id_media))&&(is_numeric($id_article))){

        $req = "SELECT * FROM article
        INNER JOIN article_has_medias
        ON article.id_article = article_has_medias.article_id_article
        INNER JOIN medias
        ON medias.id_medias = article_has_medias.medias_id_medias
        WHERE article.id_article = $id_article
        AND medias.id_medias =  $id_media
        ";
        // var_dump($req);
        $query = $this->db->query($req);
        return ($this->db->affected_rows == 1)?TRUE:FALSE;
    }
  
  }
  //--------------------------------------------------------
  //verif relation id_baby et id_article
  //--------------------------------------------------------
  function verifRelationBabyArticle($id_baby, $id_article){
    if((is_numeric($id_baby))&&(is_numeric($id_article))){

        $req = "SELECT * FROM article
        INNER JOIN baby_has_article
        ON article.id_article = baby_has_article.article_id_article
        INNER JOIN baby
        ON baby.id_baby = baby_has_article.baby_id_baby
        WHERE article.id_article = $id_article
        AND baby.id_baby =  $id_baby
        ";
        // var_dump($req);
        $query = $this->db->query($req);
        return ($this->db->affected_rows == 1)?TRUE:FALSE;
    }
  
  }
  
}
