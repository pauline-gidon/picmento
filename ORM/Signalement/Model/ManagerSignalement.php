<?php
namespace ORM\Signalement\Model;

use DateTime;
use OCFram\Manager;
use ORM\Signalement\Entity\Signalement;

class ManagerSignalement extends Manager {

    //----------------------------------------------------------
	//insertion d'un signalement
	//----------------------------------------------------------

    function insertNewSignalement(Signalement $obj){
        $text_signalement 	= $this->db->real_escape_string($obj->getTextSignalement());
        $date_signalement 	= $obj->getDateSignalement();
        $user_id_user 	= $_SESSION["auth"]["id"];
        $article_id_article 	= $this->db->real_escape_string($obj->getArticleIdArticle());
        $commentaire_id_commentaire 	= $this->db->real_escape_string($obj->getCommentaireIdCommentaire());
        $medias_id_medias 	= $this->db->real_escape_string($obj->getMediasIdMedias());
        if(empty($article_id_article)){
            $article_id_article = 'NULL';
        }
        if(empty($commentaire_id_commentaire)){
            $commentaire_id_commentaire = 'NULL';
        }
        if(empty($medias_id_medias)){
            $medias_id_medias = 'NULL';
        }
        $req = "
        INSERT INTO signalement VALUES(
            NULL,
            '$text_signalement',
            '$date_signalement',
            '$user_id_user',
            $article_id_article ,
            $commentaire_id_commentaire,
             $medias_id_medias
        )
    ";
    $query = $this->db->query($req);
    return $this->db->insert_id;


    }

    // ----------------------------------------------------------
	// tous les signalements
	// ----------------------------------------------------------
    function fullSignalement(){
        $req = "SELECT * FROM signalement INNER JOIN user ON user.id_user = signalement.user_id_user
        LEFT JOIN article ON article.id_article = signalement.article_id_article
        LEFT JOIN commentaire ON commentaire.id_commentaire = signalement.commentaire_id_commentaire
        LEFT JOIN medias ON medias.id_medias = signalement.medias_id_medias
        ";
        $query = $this->db->query($req);
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
            $objs[] = new Signalement($row);
            }
            return $objs;
        }else{
            return null;
        }      

    }


}
