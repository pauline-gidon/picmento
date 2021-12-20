<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();


echo "<p class=\"btnaddamis\"><a href=\"demande-ami\" title=\"Demande d'ami\"><i class=\"fas fa-plus\"></i><span>Ajouter un ami</span></a></p>";
if(isset($result["messages"])){
// var_dump($result);
echo "<section class=\"fc fw \">
        <div class=\"fc fw jc-c messagerie-global\">
            <p class=\"card-msg\">
                <a href=\"afficher-souvenirs-proposer\" title=\"Voir les propositions de souvenirs\">
                Souvenir(s) reçu";  
                if($result["souvenirs"]["nb"] == 0){
                    echo "<span><i class=\"fas fa-envelope-open\"></i></span>";
                }else{
                    echo "<span><i class=\"fas fa-envelope\"></i><br></span>";
                }
                echo"<span>Nouveau<br>".$result["souvenirs"]["nb"]."</span> 
                </a> 
             </p>

            <p class=\"card-msg\">
                <a href=\"afficher-messages\" title=\"Voir les messages reçu\">
                Message(s) reçu";  
                if($result["messages"]["nb"] == 0){
                    echo "<span><i class=\"fas fa-envelope-open\"></i></span>";
                }else{
                    echo "<span><i class=\"fas fa-envelope\"></i></span>";
                }
                echo "<span>Nouveau <br>".$result["messages"]["nb"]."</span> 
                </a> 
            </p>
        </div>
        <div class=\"listAmis\">";

 

if(isset($result["user"])){

    foreach ($result["user"] as $obj) {
         //avatar de la personne
         
         if(is_null($obj["user-amis"]->getAvatarUser())){
             $avatar = "avatar-picmento.png";
         }else{
             $avatar = $obj["user-amis"]->getAvatarUser();
         }
        if(!is_null($obj["user-amis"]->getNomUser())){
            $actif = $obj["demande_amis"]->getActifAmis();
            
        echo"<div class=\"wrap fc fw ai-c jc-sb userListeAmis\">
                <div class=\"fc ai-c moduleUser\">
                    <div class=\"avatar-rond\">
                    <img src=\"".DOMAINE."medias/avatar/".$avatar."\" alt=\"Photo de ".$obj["user-amis"]->getPrenomUser()." ".$obj["user-amis"]->getNomUser()."\">
                    </div>
                    <p class=\"nomUserMessagerie\">".$obj["user-amis"]->getPrenomUser()." ".$obj["user-amis"]->getNomUser()."</p>
                </div>";
                if($actif ==1){


                    echo "<div class=\"fc fw ai-c jc-sb gestionAmis\">
                            <p>
                                <a href=\"amis-voir-tribu-".$obj["user-amis"]->getIdUser()."\" title=\"Voir ses tribus\">
                                    <i class=\"fas fa-eye\"></i>
                                </a>
                            </p>
                            <p>
                                <a href=\"amis-envoyer-message-".$obj["user-amis"]->getIdUser()."\" title=\"Envoyer un message\">
                                    <i class=\"fas fa-envelope\"></i>
                                </a>
                            </p>
                            <p>
                                <a href=\"supprimer-ami-".$obj["user-amis"]->getIdUser()."\" title=\"bloquer votre ami\" class=\"gogo\" data-gogo=\"votre ami(e)\">
                                    <i class=\"fas fa-trash\"></i>
                                </a>
                            </p>
                    </div>";

                }

            echo"</div>";
        }
        }
}
    echo "</div>
    </section>";
}
?>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/front/js/visuFeedback.js" defer></script>
