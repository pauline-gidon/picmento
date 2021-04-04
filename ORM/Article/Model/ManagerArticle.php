<?php
namespace ORM\Article\Model;
use OCFram\Manager;
use ORM\Article\Entity\Article;
use ORM\Baby\Entity\Baby;
use ORM\Commentaire\Entity\Commentaire;
use ORM\Medias\Entity\Medias;

class ManagerArticle extends Manager {
    //----------------------------------------------------------
	//tous les articles de ce baby par son id_baby 
	//----------------------------------------------------------
    function articlesWithBabyById($id_baby){
        if(is_numeric($id_baby)){
            $req = "SELECT * FROM
            baby_has_article
              INNER JOIN article
                   ON baby_has_article.article_id_article = article.id_article
               INNER JOIN baby
                   ON baby_has_article.baby_id_baby = baby.id_baby 
                   WHERE baby.id_baby = $id_baby
                   ORDER BY article.date_article DESC";

            $query = $this->db->query($req);     
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $articles[] = new Article($row);
                }
                return $articles;
            }else{
                return null;
            }      
   
        }
    }
    //----------------------------------------------------------
	//un article avec cet id en bdd 
	//----------------------------------------------------------
    function oneArticleById($id){
        if(is_numeric($id)){
            $req = "SELECT * FROM article
  
                   WHERE id_article = $id";

            $query = $this->db->query($req);     
            return ($query->num_rows == 1)?new Article($query->fetch_array()):NULL;
        
        }
    }
    //----------------------------------------------------------
	//Selectionner tous les article du baby avec ses medias si il y en as
	//----------------------------------------------------------
    function fullArticle($id_baby){
        if(is_numeric($id_baby)){
            
            $req = "SELECT 
            article.id_article,
            article.titre_article,
            article.description_article,
            article.date_article,
            article.actif_article,
            GROUP_CONCAT(medias.id_medias SEPARATOR '/') AS liste_id,
            GROUP_CONCAT(medias.nom_medias SEPARATOR '/') AS liste_photo
            FROM article
            LEFT JOIN article_has_medias
            ON article_has_medias.article_id_article = id_article
            LEFT JOIN medias
            ON medias.id_medias = medias_id_medias
            INNER JOIN baby_has_article
            ON baby_has_article.article_id_article = id_article
            WHERE baby_id_baby = $id_baby
            GROUP BY article.id_article
            ORDER BY article.date_article DESC
                   ";



            $query = $this->db->query($req);     
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $articles[] = new Article($row);
                }
                return $articles;
            }else{
                return null;
            }      
   
        }
    }
    //----------------------------------------------------------
	//Suppression des articles du baby avec ces commentaires  et ces tables associatives par l'id_article
	//----------------------------------------------------------

    function deleteArticleById($id){
        if(is_numeric($id)){
            // $req = "DELETE FROM commentaire WHERE article_id_article = $id";
            // $query = $this->db->query($req);

            $req = "DELETE FROM baby_has_article WHERE article_id_article = $id";
            $query = $this->db->query($req);

            $req = "DELETE FROM article WHERE id_article = $id";
            $query = $this->db->query($req);

            return ($this->db->affected_rows == 1)?true:false;

        }
    }

    //----------------------------------------------------------
	//ajouter un souvenir avec ses medias
	//----------------------------------------------------------

    function insertArticle(Article $new_article){

        $titre_article = $this->db->real_escape_string($new_article->getTitreArticle());
        $description_article = $this->db->real_escape_string($new_article->getDescriptionArticle());
        $date_article = $this->db->real_escape_string($new_article->getDateArticle());
        $actif_article = $this->db->real_escape_string($new_article->getActifArticle());
        $user_id_user = $_SESSION["auth"]["id"];

        $req = "
        INSERT INTO article 
        VALUES(
            NULL,
            '$titre_article',
            '$description_article',
            '$date_article',
            '$actif_article',
            '$user_id_user')";
    $query = $this->db->query($req);
    return $this->db->insert_id;
     
    }
    //--------------------------------------------------------
	//Association de l'article a son baby
	//--------------------------------------------------------
	function insertArticleHasbaby($id_baby,$id_article){
        if((is_numeric($id_baby)) && (is_numeric($id_article))) {
            $req = "
                INSERT INTO baby_has_article 
                VALUES(
                    '$id_baby',
                    '$id_article'
                )";
            $query = $this->db->query($req);
            return ($this->db->affected_rows == 1)?true:false;
        }
	}

    //----------------------------------------------------------
	// update Article
	//----------------------------------------------------------
    function updateArticle(Article $article){

		$titre_article		        = $this->db->real_escape_string($article->getTitreArticle());
		$description_article	= $this->db->real_escape_string($article->getDescriptionArticle());
		$date_article	= $this->db->real_escape_string($article->getDateArticle());
		$actif_article	= $this->db->real_escape_string($article->getActifArticle());

        $req = "UPDATE article SET 
        titre_article			        = '$titre_article',
        description_article		    = '$description_article',
        date_article		= '$date_article', 
        actif_article		    = '$actif_article'

        WHERE id_article = ".$article->getIdArticle();
        
        $query = $this->db->query($req);
        if($this->db->affected_rows == 1){
			return true;
		}else{
			return false;
		}

    }
    //----------------------------------------------------------
	// quel baby est associé  cet id_article 
	//----------------------------------------------------------
    function babyWithArticleById($id){
        if(is_numeric($id)){
            $req = "SELECT * FROM article
            INNER JOIN baby_has_article
                      ON baby_has_article.article_id_article = article.id_article 
                       INNER JOIN baby
                           ON baby_has_article.baby_id_baby = baby.id_baby 
                           WHERE article.id_article = $id";

            $query = $this->db->query($req);     
            return ($query->num_rows > 0)?new Baby($query->fetch_array()):NULL;
        }
    }

    //----------------------------------------------------------
	//combien de media son associé a cet article
	//----------------------------------------------------------
    function articleCountMedias($id){
        if(is_numeric($id)){
            $req = "SELECT * FROM article
            INNER JOIN article_has_medias
                      ON article_has_medias.article_id_article = article.id_article 
                       INNER JOIN medias
                           ON article_has_medias.medias_id_medias = medias.id_medias 
                           WHERE article.id_article = $id";

            $query = $this->db->query($req);     
            if($query->num_rows < 3){
                return true;
            }else{
                return false;
            }      

        }
    }

    // //----------------------------------------------------------
	// // quel baby est associé  cet id_article 
	// //----------------------------------------------------------
    // function articleByIdMedias($id_medias){
    //     if(is_numeric($id_medias)){
    //         $req = "SELECT * FROM article
    //         INNER JOIN article_has_medias
    //         ON article_has_medias.article_id_article = article.id_article
    //         INNER JOIN medias
    //         ON article_has_medias.medias_id_medias = medias.id_medias
    //         WHERE medias.id_medias = $id_medias";

    //         $query = $this->db->query($req);     
    //         return ($query->num_rows > 0)?new Article($query->fetch_array()):NULL;
    //     }
    // }



	




}
