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
			return ($query->num_rows > 0)?new User($query->fetch_array()):NULL;
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



//Fermeture ManagerUser
}
