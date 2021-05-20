<?php
namespace ORM\User\Model;
use OCFram\Manager;
use ORM\User\Entity\User;

class ManagerUser extends Manager {

	//----------------------------------------------------------
	//Un user avec cet email existe-t-il déjà dans la BDD ?
	//----------------------------------------------------------
	function userExist($email){
		$email 	= $this->db->real_escape_string($email);

		$req 		= "SELECT * FROM user WHERE email_user = '$email' ";
		$query 	= $this->db->query($req);
		//return ($query->num_rows == 1)? true : false;
		return ($query->num_rows == 1)? new User($query->fetch_array()) : null;
	}

	//----------------------------------------------------------
	//Un user avec ce pseudo existe-t-il déjà dans la BDD ?
	//----------------------------------------------------------
	function pseudoExist($pseudo){
		$pseudo 	= $this->db->real_escape_string($pseudo);

		$req 		= "SELECT * FROM user WHERE pseudo_user = '$pseudo' ";
		$query 	= $this->db->query($req);
		//return ($query->num_rows == 1)? true : false;
		return ($query->num_rows == 1)? new User($query->fetch_array()) : null;
	}


	//----------------------------------------------------------
	//Insérer un nouveau User
	//----------------------------------------------------------
	function insertUser(User $new_user){
		//Appel d'une méthode dans le Manager pour parcourir l'objet User et lui appliquer des real_escape_string
		//!!! Appel ici avant la req d'insertion !!!
		$req 		= "INSERT INTO user VALUES(
			NULL,
			'".$new_user->getNomUser()."',
			'".$new_user->getPrenomUser()."',
			'".$new_user->getPseudoUser()."',
			'".$new_user->getEmailUser()."',
			'".hash("whirlpool",$new_user->getPassUser())."',
			NULL,
			'".$new_user->getRgpdUser()."',
			'".$new_user->getDateRgpdUser()."',
			".$new_user->getStatutUser().",
			".$new_user->getActifUser().",
			'".$new_user->getTokenUser()."',
			'".$new_user->getValidityTokenUser()."'
		)";
		$query 	= $this->db->query($req);

		return $this->db->insert_id;
	}
	//----------------------------------------------------------
	//Insérer user via invitation ( juste email )
	//----------------------------------------------------------
	function insertEmailUserInvitation($email){

        $email = $this->db->real_escape_string($email);
		$req 		= "INSERT INTO user VALUES(
            NULL,
			NULL,
			NULL,
			NULL,
			'$email',
			NULL,
			NULL,
			NULL,
			null,
			NULL,
			NULL,
			NULL,
			NULL
		)";
		$query 	= $this->db->query($req);

		return $this->db->insert_id;
	}


	//----------------------------------------------------------
	//L'activation du compte (via la réception d'un mail 
	//d'activation) nécessite de savoir si un token valide (avec
	//une durée de validité non périmée) existe dans la table
	//----------------------------------------------------------
	function oneUserByTokenValid($token){
		if(is_numeric($token)){
			$req 	= "SELECT * 
				FROM user 
					WHERE 
						token_user = '$token' 
						AND validity_token_user >= NOW()
			";

			$query 	= $this->db->query($req);
		}
	}

	//----------------------------------------------------------
	//Si le controller pointe un token valide
	//il lance l'update pour activer le User
	//----------------------------------------------------------
	function updateActivationUser(User $user){
		$req = "UPDATE user SET 
			actif_user		= 1, 
			statut_user 	= 1
			WHERE id_user = ".$user->getIdUser();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	//----------------------------------------------------------
	//S'il faut réattribuer un token 
	//(user trop lent pour activer son compte)
	//----------------------------------------------------------
	function updateTokenUser(User $user){
		$req = "UPDATE user SET 
			token_user		= '".$user->getTokenUser()."', 
			validity_token_user 	= '".$user->getValidityTokenUser()."' 
			WHERE id_user = ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	//----------------------------------------------------------
	//Et pour se connecter ?
	//----------------------------------------------------------
	function connectUser($login,$pass){
		$login_user 	= $this->db->real_escape_string($login);
		$pass_user 		= hash("whirlpool",$pass);

		$req = "SELECT * FROM user 
			WHERE 
				email_user = '$login_user' 
				AND pass_user = '$pass_user' 
				AND actif_user = 1 
				AND statut_user > 0
		";
		$query = $this->db->query($req);
		return ($query->num_rows == 1)?new User($query->fetch_array()):NULL;
	}

	//----------------------------------------------------------
	//On update juste le mot de passe du User
	//----------------------------------------------------------
	function updatePassUser(User $user){
		$pass_user		= hash("whirlpool",$user->getPassUser());
		
		$req = "UPDATE user SET 
			pass_user		= '$pass_user'
			WHERE id_user = ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}


	//----------------------------------------------------------
	//Pour laisser un User modifier son profil, 
	//on commence par récupérer tout ce qui le concerne
	//----------------------------------------------------------
	function oneUserById($id){
		if(is_numeric($id)){
			$req 	= "
				SELECT * 
				FROM user 
				WHERE 
					id_user = $id 
			";
			$query 	= $this->db->query($req);
			return ($query->num_rows == 1)?new User($query->fetch_array()):NULL;
		}
	}
	//----------------------------------------------------------
	//Mais un User ne peut modifier son profil 
	//sans retaper son mot de passe actuel
	//----------------------------------------------------------
	function oneUserByIdAndPass(User $user) {
		$pass_user  = hash("whirlpool",$user->getPassUser());

		$req 	= "SELECT * FROM user 
			WHERE pass_user = '$pass_user' 
				AND id_user = ".$user->getIdUser();
		$query 	= $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:FALSE;
	}

	function updateProfil(User $user){
		$nom_user		= $this->db->real_escape_string($user->getNomUser());
		$prenom_user	= $this->db->real_escape_string($user->getPrenomUser());
		$pseudo_user	= $this->db->real_escape_string($user->getPseudoUser());
		$email_user		= $this->db->real_escape_string($user->getEmailUser());
		
		$req = "UPDATE user SET 
				nom_user			= '$nom_user',
				prenom_user		= '$prenom_user',
				pseudo_user		= '$pseudo_user',
				email_user		= '$email_user' 
			WHERE id_user = ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}


	//----------------------------------------------------------
	//Supprimer compte par id_user
	//----------------------------------------------------------
	function deleteUser($id){
        if(is_numeric($id)){
            $req = "DELETE FROM user 
            WHERE id_user=".$id;
            $query = $this->db->query($req);
            return ($this->db->affected_rows == 1)?TRUE:FALSE;
        }
	}


	//----------------------------------------------------------
	//Modifier Avatar
	//----------------------------------------------------------
	function updateAvatar(User $user){
		$avatar = $user->getAvatarUser();

		$req = "UPDATE user 
			SET avatar_user = '$avatar'
			WHERE id_user =".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}
	//----------------------------------------------------------
	//Ajouter des relation entre user
	//----------------------------------------------------------
	function insertUserHasUser($id1, $id2){
        if((is_numeric($id1)) && (is_numeric($id2))) {
            $req="INSERT INTO user_has_user VALUES (

            '$id1',
            '$id2'
            )";
            $query = $this->db->query($req);
            return ($this->db->affected_rows == 1)?TRUE:FALSE;
        }
	}

	//----------------------------------------------------------
	//Je verifie les relation d'amitié
	//----------------------------------------------------------
	function oneUserHasUser($id1, $id2){
        if((is_numeric($id1)) && (is_numeric($id2))) {
            $req="SELECT * FROM user_has_user WHERE
        	    user_id_user  = '$id1' 
				AND user_id_user1  = '$id2'
                OR user_id_user  = '$id2' 
				AND user_id_user1  = '$id1'
        ";
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
        }
	}

    //----------------------------------------------------------
	// je verifie si ce baby appartien a la personne connecter par idparent1 ou parent 2 de sa tribu
	//----------------------------------------------------------
    function verifUserBaby($id_baby, $id_user){
        if((is_numeric($id_user)) && (is_numeric($id_baby))){
           $req= "SELECT * FROM baby
			INNER JOIN tribu
            ON baby.tribu_id_tribu = tribu.id_tribu
            INNER JOIN user
            ON tribu.user_id_parent1 = user.id_user OR tribu.user_id_parent2 = user.id_user
            WHERE user.id_user = $id_user
            And baby.id_baby = $id_baby";        
		$query 	= $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:FALSE;
        }

    }
    //----------------------------------------------------------
	// Controle de la personne connecter id medias
	//----------------------------------------------------------
    function verifUserMedias($id_medias){
        $user_id = $_SESSION["auth"]["id"];
        if((is_numeric($user_id)) && (is_numeric($id_medias))){
           $req= "SELECT * FROM medias
           INNER JOIN article_has_medias
           ON article_has_medias.medias_id_medias = medias.id_medias
           INNER JOIN article
           ON article_has_medias.article_id_article = article.id_article
           INNER JOIN baby_has_article
           ON baby_has_article.article_id_article = article.id_article
           INNER JOIN baby
           ON baby_has_article.baby_id_baby = baby.id_baby
           INNER JOIN tribu
           ON baby.tribu_id_tribu = tribu.id_tribu
           INNER JOIN user
           ON tribu.user_id_parent1 = user.id_user OR tribu.user_id_parent2 = user.id_user
           WHERE user.id_user = $user_id
           And medias.id_medias = $id_medias";        
		$query 	= $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:FALSE;
        }

    }
    //----------------------------------------------------------
	// Controle de la personne connecter id article
	//----------------------------------------------------------
    function verifUserArticle($id_article){
        $user_id = $_SESSION["auth"]["id"];
        if((is_numeric($user_id)) && (is_numeric($id_article))){
           $req= "SELECT * FROM article
           INNER JOIN baby_has_article
           ON baby_has_article.article_id_article = article.id_article
           INNER JOIN baby
           ON baby_has_article.baby_id_baby = baby.id_baby
           INNER JOIN tribu
           ON baby.tribu_id_tribu = tribu.id_tribu
           INNER JOIN user
           ON tribu.user_id_parent1 = user.id_user OR tribu.user_id_parent2 = user.id_user
           WHERE user.id_user = $user_id
           And article.id_article = $id_article";        
		$query 	= $this->db->query($req);
		return ($query->num_rows > 0)?TRUE:FALSE;
        }

    }

	//----------------------------------------------------------
	//Je recupère les relation d'amitié du user
    //----------------------------------------------------------
	function fullAmisUser(){
        $id = $_SESSION["auth"]["id"];
            $req="SELECT * FROM user_has_user WHERE
        	    user_id_user  = $id 
                OR user_id_user1  = $id 
        ";
		$query = $this->db->query($req);
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
            $objs[] = $row;
            }
            return $objs;
        }else{
            return null;
        }      
    
	}
    //----------------------------------------------------------
	//Verif user avant insert commentaire
	//----------------------------------------------------------
    function verifUserCommentaire($id_baby){
        $user_co = $_SESSION["auth"]["id"];
        if(is_numeric($id_baby)){

            $req = "SELECT * tribu
            INNER JOIN Baby
            ON tribu.id_tribu = baby.tribu_id_tribu
            WHERE tribu.user_id_parent1 = $user_co OR tribu.user_id_parent2 = $user_co
            AND  baby.id_baby = $id_baby
        ";
        $query = $this->db->query($req);
        return ($query->num_rows > 0)?TRUE:FALSE;
        }
    
    }

    //----------------------------------------------------------
	//Verif user has user pour la visite d'une tribu amis
	//----------------------------------------------------------
    function verifUserAmis($id_ami){
        $user_co = $_SESSION["auth"]["id"];
        if(is_numeric($id_ami)){

            $req = "SELECT * FROM user_has_user
            WHERE user_id_user = $id_ami OR user_id_user = $id_ami
            AND user_id_user1 = $user_co OR user_id_user1 = $id_ami
        ";
        $query = $this->db->query($req);
        return ($query->num_rows > 0)?TRUE:FALSE;
        }

    }
    //----------------------------------------------------------
	//Verif relation user connecter et user visité pour voir les souvenir baby
	//----------------------------------------------------------
    function verifUserAmisUserConnecter($id_parent1, $id_parent2){
        $user_co = $_SESSION["auth"]["id"];
        if((is_numeric($id_parent1))&&(is_numeric($id_parent2))){

            $req = "SELECT * FROM user_has_user
            INNER JOIN user
            ON user.id_user = user_has_user.user_id_user OR user.id_user = user_has_user.user_id_user1
            WHERE user_id_user = $id_parent1 OR user_id_user = $id_parent2 OR user_id_user = $user_co
            AND user_id_user1 = $id_parent1 OR user_id_user1 = $id_parent2 OR user_id_user = $user_co
        ";
        $query = $this->db->query($req);
        if($query->num_rows > 0){
            while($row = $query->fetch_array()){
                $objet = new User($row);
                }
            return $objet;
        }else{
            return null;
        }
    }

    }
    //----------------------------------------------------------
	//le user est déja crée grace a une invitation, quand il crée son compt je ne fait pas un insert mais un update
	//----------------------------------------------------------


	function updateProfilCreation(User $user){
		$nom_user		= $this->db->real_escape_string($user->getNomUser());
		$prenom_user	= $this->db->real_escape_string($user->getPrenomUser());
		$email_user		= $this->db->real_escape_string($user->getEmailUser());
		$pass_user	= $this->db->real_escape_string($user->getPassUser());
		$actif_user	= $this->db->real_escape_string($user->getActifUser());
		$statut_user	= $this->db->real_escape_string($user->getStatutUser());
		$rgpd_user	= $this->db->real_escape_string($user->getRgpdUser());
		$date_rgpd_user	= $this->db->real_escape_string($user->getDateRgpdUser());
		$token_user	= $this->db->real_escape_string($user->getTokenUser());
		$validity_token_user	= $this->db->real_escape_string($user->getValidityTokenUser());
        $pass_userOK = hash("whirlpool",$pass_user);
		
		$req = "UPDATE user SET 
				nom_user			= '$nom_user',
				prenom_user		= '$prenom_user',
				pass_user		= '$pass_userOK',
				actif_user		= '$actif_user', 
				statut_user		= '$statut_user', 
				rgpd_user		= '$rgpd_user',
				date_rgpd_user		= '$date_rgpd_user',
				token_user		= '$token_user',
				validity_token_user		= '$validity_token_user' 
			WHERE email_user = '$email_user'";
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}
    

//Fermeture ManagerUser
}
