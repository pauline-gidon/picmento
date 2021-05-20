<?php
namespace ORM\Article\Model;
use OCFram\Manager;
use ORM\Baby\Entity\Baby;
use ORM\User\Entity\User;
use ORM\Medias\Entity\Medias;
use ORM\Article\Entity\Article;
use ORM\Commentaire\Entity\Commentaire;

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
	//Selectionner tous les article du baby avec ses medias si il y en as et le user qui a crée le souvenir
	//----------------------------------------------------------
    function fullArticleWithMedias($id_baby){
        if(is_numeric($id_baby)){
            
            $req = "SELECT 
            article.id_article,
            article.titre_article,
            article.description_article,
            article.date_article,
            article.actif_article,
            article.user_id_user,
            user.avatar_user,
            user.nom_user,
            user.prenom_user,
            user.pseudo_user,
            GROUP_CONCAT(medias.id_medias SEPARATOR '/') AS liste_id,
            GROUP_CONCAT(medias.nom_medias SEPARATOR '/') AS liste_photo
            FROM article
            LEFT JOIN article_has_medias
            ON article_has_medias.article_id_article = id_article
            LEFT JOIN medias
            ON medias.id_medias = medias_id_medias
            INNER JOIN baby_has_article
            ON baby_has_article.article_id_article = id_article
            INNER JOIN user
            ON article.user_id_user = user.id_user
            WHERE baby_id_baby = $id_baby
            GROUP BY article.id_article
            ORDER BY article.date_article DESC,article.id_article DESC
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
	//Selectionner tous les article du baby avec ses commentaires si il y en a
	//----------------------------------------------------------
    function fullArticleWithCommentaire($id_baby){
        if(is_numeric($id_baby)){
            
            $req = "SELECT 
            article.id_article,
            article.titre_article,
            article.description_article,
            article.date_article,
            article.actif_article,
            GROUP_CONCAT(commentaire.id_commentaire SEPARATOR '/') AS liste_id_com,
            GROUP_CONCAT(commentaire.description_commentaire SEPARATOR '/') AS liste_desc_com,
            GROUP_CONCAT(commentaire.user_id_user SEPARATOR '/') AS liste_is_user_com
            FROM article
   			LEFT JOIN commentaire
            ON commentaire.article_id_article = article.id_article
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
	//Selectionner tous les article du baby avec ses medias si il y en as et commentaires idem
	//----------------------------------------------------------
    function fullArticleWithMediasAndCommentaire($id_baby){
        if(is_numeric($id_baby)){
            
            $req = "SELECT 
            article.id_article,
            article.titre_article,
            article.description_article,
            article.date_article,
            article.actif_article,
           
            GROUP_CONCAT(DISTINCT user.id_user SEPARATOR '/') AS liste_id_user,
            GROUP_CONCAT(DISTINCT user.avatar_user SEPARATOR '/') AS liste_avatar_user,
            GROUP_CONCAT(DISTINCT user.nom_user SEPARATOR '/') AS liste_nom_user,
            GROUP_CONCAT(DISTINCT user.prenom_user SEPARATOR '/') AS liste_prenom_user,
            GROUP_CONCAT(DISTINCT  user.pseudo_user SEPARATOR '/') AS liste_pseudo_user,
            GROUP_CONCAT(DISTINCT medias.id_medias SEPARATOR '/') AS liste_id,
            GROUP_CONCAT(DISTINCT medias.nom_medias SEPARATOR '/') AS liste_photo,
            GROUP_CONCAT(DISTINCT commentaire.id_commentaire SEPARATOR '/') AS liste_id_com,
            GROUP_CONCAT(DISTINCT commentaire.description_commentaire SEPARATOR '/') AS liste_desc_com,
            GROUP_CONCAT(DISTINCT commentaire.user_id_user SEPARATOR '/') AS liste_id_user_com
            FROM article
	  	    LEFT JOIN article_has_medias
            ON article_has_medias.article_id_article = id_article
            LEFT JOIN medias
            ON medias.id_medias = medias_id_medias
   			LEFT JOIN commentaire
            ON commentaire.article_id_article = article.id_article
            INNER JOIN baby_has_article
            ON baby_has_article.article_id_article = id_article
            INNER JOIN user
            ON user.id_user = commentaire.user_id_user
            WHERE baby_id_baby = $id_baby
            GROUP BY article.id_article
            ORDER BY article.date_article DESC , liste_id_user DESC
                   ";



            $query = $this->db->query($req);     
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $objs[] = new Article($row);
                }
                return $objs;
            }else{
                return null;
            }      
   
        }
    }
    //----------------------------------------------------------
	//Selectionner tous les commentaire de l'article
	//----------------------------------------------------------
    function oneArticleWithCommentaireByIdArticle($id_article){
        if(is_numeric($id_article)){
            
            $req = "SELECT * FROM commentaire
            INNER JOIN article
            ON commentaire.article_id_article = article.id_article
            INNER JOIN user
            ON commentaire.user_id_user = user.id_user
            WHERE article.id_article = $id_article
            ORDER BY commentaire.id_commentaire"; 
                



            $query = $this->db->query($req);     
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $objs[] = new Commentaire($row);
                }
                return $objs;
            }else{
                return null;
            }      
   
        }
    }


    //----------------------------------------------------------
    //je supprime une relation avant de supprimer l'article pour voir si l'article est associé a d'autre baby
	//----------------------------------------------------------

    function deleteArticleHasBaby($id_article, $id_baby){
        if((is_numeric($id_article))&&(is_numeric($id_baby))){
            // $req = "DELETE FROM commentaire WHERE article_id_article = $id";
            // $query = $this->db->query($req);

            $req = "DELETE FROM baby_has_article WHERE article_id_article = $id_article
            AND baby_id_baby = $id_baby";
            $query = $this->db->query($req);
            return ($this->db->affected_rows == 1)?true:false;

        }
    }
    //----------------------------------------------------------
    //je regarde si cette article est associé a un/des baby(s)
	//----------------------------------------------------------

    function fullArticleHasBaby($id_article){
        if(is_numeric($id_article)){
            // $req = "DELETE FROM commentaire WHERE article_id_article = $id";
            // $query = $this->db->query($req);

            $req = "SELECT * FROM article INNER JOIN baby_has_article ON baby_has_article.article_id_article = article.id_article
            INNER JOIN baby ON baby_has_article.baby_id_baby = baby.id_baby
             WHERE article.id_article = $id_article";
            $query = $this->db->query($req);
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $objs[] = new Baby($row);
                }
                return $objs;
            }else{
                return null;
            }      

        }
    }
    //----------------------------------------------------------
    //je supprime l'article qui n'est plus associé a des babys
	//----------------------------------------------------------

    function deleteArticleByIds($id_article){
        if((is_numeric($id_article))){

            $req = "DELETE FROM article WHERE id_article = $id_article";
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
        $validation_article = $this->db->real_escape_string($new_article->getValidationArticle());

        $req = "
        INSERT INTO article 
        VALUES(
            NULL,
            '$titre_article',
            '$description_article',
            '$date_article',
            '$actif_article',
            '$user_id_user',
            $validation_article
            )";
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
		$validation_article	= $this->db->real_escape_string($article->getValidationArticle());

        $req = "UPDATE article SET 
        titre_article			        = '$titre_article',
        description_article		    = '$description_article',
        date_article		= '$date_article',
        actif_article		    = '$actif_article',
        validation_article		    = '$validation_article'

        WHERE id_article = ".$article->getIdArticle();
        
        $query = $this->db->query($req);
        if($this->db->affected_rows == 1){
			return true;
		}else{
			return false;
		}

    }
    //----------------------------------------------------------
	// quel(s) baby(s) est associé  cet id_article 
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
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $objs[] = new Baby($row);
                }
                return $objs;
            }else{
                return null;
            }      
        }
    }

    //----------------------------------------------------------
	//combien de media son associé a cet article pour empéché l'upload de nouveau fichier
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
    //----------------------------------------------------------
	//Recupéré tous les medias pour la suppression de l'article
	//----------------------------------------------------------
    function articleCountMediasById($id){
        if(is_numeric($id)){
            $req = "SELECT * FROM article
            INNER JOIN article_has_medias
                      ON article_has_medias.article_id_article = article.id_article 
                       INNER JOIN medias
                           ON article_has_medias.medias_id_medias = medias.id_medias 
                           WHERE article.id_article = $id";

            $query = $this->db->query($req);     
            if($query->num_rows > 0){
                while($row = $query->fetch_array()){
                $objs[] = new Medias($row);
                }
                return $objs;
            }else{
                return null;
            }      

        }
    }
    //----------------------------------------------------------
	//POUR  LES AMIS Selectionner tous les article ACTIF du baby avec ses medias si il y en as et le user qui a crée le souvenir
	//----------------------------------------------------------
    function fullArticleActifWithMedias($id_baby){
        if(is_numeric($id_baby)){
            
            $req = "SELECT 
            article.id_article,
            article.titre_article,
            article.description_article,
            article.date_article,
            article.actif_article,
            article.user_id_user,
            user.nom_user,
            user.avatar_user,
            user.prenom_user,
            user.pseudo_user,
            GROUP_CONCAT(medias.id_medias SEPARATOR '/') AS liste_id,
            GROUP_CONCAT(medias.nom_medias SEPARATOR '/') AS liste_photo
            FROM article
            LEFT JOIN article_has_medias
            ON article_has_medias.article_id_article = id_article
            LEFT JOIN medias
            ON medias.id_medias = medias_id_medias
            INNER JOIN baby_has_article
            ON baby_has_article.article_id_article = id_article
            INNER JOIN user
            ON article.user_id_user = user.id_user
            WHERE baby_id_baby = $id_baby
            AND article.actif_article = 1
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
	//un article avec ce baby? pour verifier la modification du commentaire
	//----------------------------------------------------------
    function oneArticleByIds($id_article, $id_baby){
        if((is_numeric($id_article)) && (is_numeric($id_baby))){
            $req = "SELECT * FROM baby_has_article WHERE article_id_article  = $id_article and baby_id_baby = $id_baby";
            $query = $this->db->query($req);
            if($query->num_rows == 1){
                return true;
            }else{
                return false;
            }
   
        }
    }
    //----------------------------------------------------------
	//tous les article pas validé avec ces medias
	//----------------------------------------------------------
    function fullArticlesValidationZero(){
        $id_user = $_SESSION["auth"]["id"];

        // $req = "SELECT * FROM article
        // INNER JOIN baby_has_article
        // on baby_has_article.article_id_article = article.id_article
        // INNER JOIN baby
        // on baby_has_article.baby_id_baby = baby.id_baby
        // INNER JOIN tribu
        // ON baby.tribu_id_tribu = tribu.id_tribu
        // INNER JOIN user
        // ON tribu.user_id_parent1 = user.id_user
        // OR tribu.user_id_parent2 = user.id_user
        // WHERE article.validation_article = 0
        // AND user.id_user = $id_user
        // GROUP BY article.id_article";

        $req = "SELECT
        article.id_article,
        article.titre_article,
        article.description_article,
        article.date_article,
        article.user_id_user,
        user.nom_user,
        user.avatar_user,
        user.prenom_user,
        user.pseudo_user,
        GROUP_CONCAT(DISTINCT medias.id_medias SEPARATOR '/') AS liste_id_photo,
        GROUP_CONCAT(DISTINCT medias.nom_medias SEPARATOR '/') AS liste_nom_photo,
        GROUP_CONCAT(DISTINCT baby.id_baby SEPARATOR '/') AS liste_id_baby,
        GROUP_CONCAT(DISTINCT baby.nom_baby SEPARATOR '/') AS liste_nom_baby,
        GROUP_CONCAT(DISTINCT baby.photo_baby SEPARATOR '/') AS liste_photo_baby
        FROM article
        INNER JOIN baby_has_article
        on baby_has_article.article_id_article = article.id_article
        INNER JOIN baby
        on baby_has_article.baby_id_baby = baby.id_baby
        INNER JOIN tribu
        ON baby.tribu_id_tribu = tribu.id_tribu
        LEFT JOIN article_has_medias
        ON article_has_medias.article_id_article = id_article
        LEFT JOIN medias
        ON medias.id_medias = medias_id_medias
        INNER JOIN user
        ON tribu.user_id_parent1 = user.id_user
        OR tribu.user_id_parent2 = user.id_user
        WHERE article.validation_article = 0
        AND user.id_user = $id_user
        GROUP BY article.id_article
            ";

        // print_r($req);die();
        $query = $this->db->query($req);     
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
            $tableaux [] = new Article($row);
      
            }
            return $tableaux;
        }else{
            return null;
        }      


    }

    //----------------------------------------------------------
	//tous les article pas validé
	//----------------------------------------------------------
    function countArticlesValidationZero(){
        $id_user = $_SESSION["auth"]["id"];

        $req = "SELECT * FROM article
        INNER JOIN baby_has_article
        on baby_has_article.article_id_article = article.id_article
        INNER JOIN baby
        on baby_has_article.baby_id_baby = baby.id_baby
        INNER JOIN tribu
        ON baby.tribu_id_tribu = tribu.id_tribu
        INNER JOIN user
        ON tribu.user_id_parent1 = user.id_user
        OR tribu.user_id_parent2 = user.id_user
        WHERE article.validation_article = 0
        AND user.id_user = $id_user
        GROUP BY article.id_article";
        $query = $this->db->query($req);     
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
            $tableau[] = new Article($row);
            }
            return $tableau;
        }else{
            return null;
        }      


    }

    //----------------------------------------------------------
	//autocomplete zone recherche
	//----------------------------------------------------------

	function autocompletion($saisie){
		$saisie = $this->db->real_escape_string($saisie);

		$req = "SELECT * FROM article 
			WHERE titre_article LIKE '%$saisie%' 
			ORDER BY titre_article
            LIMIT 5
		";
		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new Article($row);
			}

			return $tableau;
		}else{
			return NULL;
		}
	}




}
