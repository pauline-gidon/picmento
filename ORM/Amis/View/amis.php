<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();

echo "<p class=\"btnAddAmis\"><a href=\"demande-ami\" title=\"Demande d'ami\"> Ajouter <br>un ami<i class=\"fas fa-user-plus\"></i></a></p>";
if(isset($result)){
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
                <a href=\"afficher-messages-recu\" title=\"Voir les messages reçu\">
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
        
        foreach ($result["user-amis"] as $obj) {
             //avatar de la personne
             if(is_null($obj->getAvatarUser())){
                 $avatar = "avatar-picmento.png";
             }else{
                 $avatar = $obj->getAvatarUser();
             }
            echo"<div class=\"fc fw ai-c userListeAmis\">
                    <div class=\"avatar-rond\">
                        <img src=\"".DOMAINE."medias/avatar/".$avatar."\" alt=\"Photo de ".$obj->getPrenomUser()." ".$obj->getNomUser()."\">
                    </div>
                    <div class=\"fc fw ai-c jc-sb\">
                        <p class=\"nomUserMessagerie\">".$obj->getPrenomUser()." ".$obj->getNomUser()."</p>
                        <div class=\"fc fw ai-c\">
                            <p>
                                <a href=\"voir-tribu-amis-".$obj->getIdUser()."\" title=\"Voir ses tribus\">
                                    <i class=\"fas fa-eye\"></i>
                                </a>
                            </p>
                            <p>
                                <a href=\"envoyer-message-".$obj->getIdUser()."\" title=\"Envoyer un message\">
                                    <i class=\"fas fa-envelope\"></i>
                                </a>
                            </p>
                        </div>
                    
                    
                    </div>
                </div>";
            }
    echo "</div>
    </section>";
}
