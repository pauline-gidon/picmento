<?php

use Vendors\Cryptor;
use Vendors\Flash\Flash;
$flash = new FLash();

$cryptor = new Cryptor();
// echo $flash->getFlash();
//$general[0]= baby
echo $flash->getFlash();

// var_dump($_SERVER);

$_SESSION["REF"] = $_SERVER["HTTP_REFERER"];

if(isset($result)){
// var_dump($result);

echo "<table class=\"table\">
<h3>Les articles</h3>
        <tr>
            <th>Personne</th>
            <th>Message</th>
            <th>Date</th>
            <th>Souvenir</th>
            <th>Voir</th>
        </tr>";

        foreach ($result as $obj) {
            if(!is_null($obj->id_article)){
                $crypted_id_article = $cryptor->encrypt($obj->id_article);
     
            echo "  
                    <tr>
                        <td>".$obj->prenom_user." ".$obj->nom_user."</td>
                        <td>".$obj->getTextSignalement()."</td>
                        <td>".$obj->getDateSignalement()."</td>
                        <td>".$obj->titre_article."</td>
                        <td>
                            <a href=\"voir-signalement-article-".$crypted_id_article."\" title=\" Voir le signalement\">
                                <i class=\"fas fa-eye\"></i>
                            </a>
                        </td>
                    </tr>";
            }
        }
echo "</table>
    <table class=\"table\">
    <h3>Les médias</h3>
        <tr>
            <th>Personne</th>
            <th>Message</th>
            <th>Date</th>
            <th>Media</th>
            <th>Voir</th>
        </tr>";
        foreach ($result as $obj) {

            if(!is_null($obj->id_medias)){
                $crypted_id_media = $cryptor->encrypt($obj->id_medias);

            echo "  
                    <tr>
                        <td>".$obj->prenom_user." ".$obj->nom_user."</td>
                        <td>".$obj->getTextSignalement()."</td>
                        <td>".$obj->getDateSignalement()."</td>
                        <td>".$obj->nom_medias."</td>
                        <td>
                            <a href=\"voir-signalement-media-".$crypted_id_media."\" title=\" Voir le signalement\">
                                <i class=\"fas fa-eye\"></i>
                            </a>
                        </td>
                    </tr>";
    
            }
            
        }
echo "</table>
    <table class=\"table\">
    <h3>Les commentaires</h3>
        <tr>
            <th>Personne</th>
            <th>Message</th>
            <th>Date</th>
            <th>Commentaire</th>
            <th>Voir</th>
        </tr>
        ";

        foreach ($result as $obj) {

            if(!is_null($obj->id_commentaire)){
                $crypted_id_commentaire = $cryptor->encrypt($obj->id_commentaire);

            echo "  
                    <tr>
                        <td>".$obj->prenom_user." ".$obj->nom_user."</td>
                        <td>".$obj->getTextSignalement()."</td>
                        <td>".$obj->getDateSignalement()."</td>
                        <td>".$obj->description_commentaire."</td>
                        <td>
                            <a href=\"voir-signalement-comentaire-".$crypted_id_commentaire."\" title=\" Voir le signalement\">
                                <i class=\"fas fa-eye\"></i>
                            </a>
                        </td>
                    </tr>";
    
            }
        }
echo "</table>";


}