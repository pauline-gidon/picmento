<?php
namespace ORM\Commentaire\Model;
use OCFram\Manager;
use ORM\Article\Entity\Article;
use ORM\Commentaire\Entity\Commentaire;

class ManagerCommentaire extends Manager {

    //----------------------------------------------------------
	//tous les commentaire de cet article par son id_article
	//----------------------------------------------------------
    function fullCommentaireByIdArticle($id_article){
        if(is_numeric($id_article)){
            $req = "SELECT * FROM commentaire INNER JOIN article
            ON commentaire.article_id_article = article.id_article
                   WHERE commentaire.article_id_article = $id_article
                   ORDER BY id_commentaire DESC";
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
            //si il est supprimer par un signalement je supprimer d'habord le signalement
            $req= "DELETE FROM signalement WHERE commentaire_id_commentaire = $id_com";
            $query = $this->db->query($req);
            
            $req = "DELETE FROM commentaire WHERE id_commentaire = $id_com";
            $query = $this->db->query($req);

            return ($this->db->affected_rows == 1)?true:false;    
   
        }
    }
    //----------------------------------------------------------
	//Select commentaire par son id
	//----------------------------------------------------------
    function oneCommentaireById($id_com){
        if(is_numeric($id_com)){
            $req = "SELECT * FROM commentaire WHERE id_commentaire = $id_com";
            $query = $this->db->query($req);

            return ($query->num_rows == 1)?new Commentaire($query->fetch_array()):NULL;
   
        }
    }

    //----------------------------------------------------------
	//insert Commentaire
	//----------------------------------------------------------
    function insertNewCommentaire(Commentaire $obj,$id_article){
        $description_commentaire = $this->db->real_escape_string($obj->getDescriptionCommentaire());
        $user_id_user = $this->db->real_escape_string($obj->getUserIdUser());
        $article_id_article = $this->db->real_escape_string($id_article);
    
        $req = "
        INSERT INTO commentaire VALUES(
            NULL,
            '$description_commentaire',
            '$user_id_user',
            '$article_id_article'
        )
        ";
        $query = $this->db->query($req);
        return $this->db->insert_id;
    }

    //----------------------------------------------------------
	//update Commentaire
	//----------------------------------------------------------
    function updateCommentaire(Commentaire $obj){
        $description_commentaire = $this->db->real_escape_string($obj->getDescriptionCommentaire());
   
        $req = "UPDATE commentaire SET 
        description_commentaire		    = '$description_commentaire'
        WHERE id_commentaire = ".$obj->getIdCommentaire()
        ;
        $query = $this->db->query($req);
        return ($this->db->affected_rows == 1)?true:false;
    }

    //----------------------------------------------------------
	//ce commentaire appartien a quel article ? id com
	//----------------------------------------------------------
    function oneArticleByIdCom($id_com){
        if(is_numeric($id_com)){
            $req = "SELECT * FROM article
            INNER JOIN commentaire
            on article.id_article = commentaire.article_id_article
            WHERE commentaire.id_commentaire =  $id_com";
            $query = $this->db->query($req);

            return ($query->num_rows > 0)?new Article($query->fetch_array()):NULL;
   
        }
    }


	
}
