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
            $req = "DELETE FROM article_has_medias WHERE medias_id_medias = $id";
            $query = $this->db->query($req);

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

        }

        $req 		= "SELECT * FROM medias WHERE id_medias = $id";
        $query = $this->db->query($req);
        return ($query->num_rows == 1)?new Medias($query->fetch_array()):NULL;

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
	
}
