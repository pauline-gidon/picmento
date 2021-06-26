<?php
use Vendors\Flash\Flash;
$flash = new FLash();
// echo $flash->getFlash();
//$general[0]= baby
echo $flash->getFlash();

// var_dump($_SERVER);

$_SESSION["REF"] = $_SERVER["HTTP_REFERER"];

if(isset($result)){
// var_dump($result);

echo "<table class=\"table\">
        <tr>
        <th>Personne</th>
        <th>Message</th>
        <th>Date</th>
        <th>Souvenir</th>
        <th>Voir</th>
        <th>Supprimer le signalement</th>

        </tr>";

        foreach ($result as $obj) {
            if(!is_null($obj->getArticleIdArticle())){
     
            echo "
                    <tr>
                    <td>".$obj->prenom_user." ".$obj->nom_user."</td>
                    <td>".$obj->getTextSignalement()."</td>
                    <td>".$obj->getDateSignalement()."</td>
                    <td>".$obj->titre_article."</td>
                    <td></td>
                    <td></td>
                    
                    </tr>";
            }
        }
echo "</table>
    <table class=\"table\">
        <tr>
        <th>Personne</th>
        <th>Message</th>
        <th>Date</th>
        <th>Media</th>
        <th>Voir</th>
        <th>Supprimer le signalement</th>


        </tr>";
        foreach ($result as $obj) {

            if(!is_null($obj->getMediasIdMedias())){
    
            echo "
                    <tr>
                    <td>".$obj->prenom_user." ".$obj->nom_user."</td>
                    <td>".$obj->getTextSignalement()."</td>
                    <td>".$obj->getDateSignalement()."</td>
                    <td>".$obj->nom_medias."</td>
                    <td></td>
                    <td></td>
                    
                    </tr>";
    
            }
        }
echo "</table>
    <table class=\"table\">
        <tr>
        <th>Personne</th>
        <th>Message</th>
        <th>Date</th>
        <th>Commentaire</th>
        <th>Voir</th>
        <th>Supprimer le signalement</th>

        
        </tr>";

        foreach ($result as $obj) {

            if(!is_null($obj->getCommentaireIdCommentaire())){
            echo "  <tr>
                    <td>".$obj->prenom_user." ".$obj->nom_user."</td>
                    <td>".$obj->getTextSignalement()."</td>
                    <td>".$obj->getDateSignalement()."</td>
                    <td>".$obj->description_commentaire."</td>
                    <td></td>
                    <td></td>
                    
                    </tr>";
    
            }
        }
echo "</table>";


}