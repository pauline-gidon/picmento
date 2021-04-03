<?php
namespace ORM\Commentaire\Model;
use OCFram\Manager;
use ORM\Commentaire\Entity\Commentaire;

class ManagerCommentaire extends Manager {

    //----------------------------------------------------------
	//tous les commentaire de cet article par son id_article
	//----------------------------------------------------------
    function commentaireHasArticleById($id_article){
        if(is_numeric($id_article)){
            $req = "SELECT * FROM commentaire INNER JOIN article
                   WHERE article_id_article = $id_article";

            $query = $this->db->query($req);     
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $commentaires[] = new Commentaire($row);
                }
                return $commentaires;
            }else{
                return null;
            }      
   
        }
    }

    //----------------------------------------------------------
	//delete commentaire par son id
	//----------------------------------------------------------
    function deleteCommentaireById($id_com){
        if(is_numeric($id_com)){
            $req = "DELETE FROM commentaire WHERE id_commentaire = $id_com";
            $query = $this->db->query($req);

            return ($this->db->affected_rows == 1)?true:false;    
   
        }
    }
	
}
