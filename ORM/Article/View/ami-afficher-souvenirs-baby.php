<?php
use Vendors\Flash\Flash;
use Vendors\Cryptor;
$flash = new FLash();
// echo $flash->getFlash();
//$general[0]= baby
$cryptor = new Cryptor();
if(isset($result["baby"])){
    echo "<h2 class\"prenom-title\">".$result["baby"]->getNomBaby()."</h2>";
}
if(isset($_SESSION["ami"]["id"])){
    echo " <a id=\"top\" href=\"amis-voir-tribu-".$_SESSION["ami"]["id"]."\" title=\"Retour au tribus de mon ami\" class=\"btn-tribu-ami\">
                <i class=\"fas fa-undo-alt\"></i>&nbsp;Tribus&nbsp;ami
            </a>";
}
echo $flash->getFlash();



if(isset($result["articles"])){
    echo "<section  class=\"fc fw wrap section-article\">";
    foreach($result["articles"] as $article){
        $obj = $article["souvenir"];
        
        $date = new DateTime($obj->getDateArticle());
        
        $year = $date->format("Y");
        $mois = $date->format("m");
        $jour = $date->format("d");
                $tableauDeMois= [
                    'JAN'=> '01',
                    'FEV'=> '02',
                    'MAR'  =>  '03',
                    'AVR' => '04',
                    'MAI'   => '05',
                    'JUN'  =>  '06',
                    'JUL' => '07',
                    'AOU' => '08',
                    'SEP' => '09',
                    'OCT' => '10',
                    'NOV' => '11',
                    'DEC' => '12'    
                ];

                $mois = array_search($mois,$tableauDeMois);
                echo "<article id=\"ancre-".$obj->getIdArticle()."\" class=\"article-baby\">
                        <h1 class=\"title\">".ucfirst($obj->getTitreArticle())."</h1>
                        <div class=\"containnerDescription\">

                        <p class=\"description\">".ucfirst($obj->getDescriptionArticle())."</p>
                        </div>

                    <p class=\"ruban-date solide\"><span>".$jour."</span><br>".$mois."</p>";
                    if(!is_null($obj->liste_photo)){
                        $photos = explode("/",$obj->liste_photo);
                        $ids = explode("/",$obj->liste_id);
            
                        echo"<div class=\"fc fw jc-c\">";
                    for ($i=0; $i < count($ids); $i++) { 

                        
                        $crypted_id_photo = $cryptor->encrypt($ids[$i]);
                        echo "<div id=\"photo".$ids[$i]."\" class=\"souv-carre\">
                                <img src=\"".DOMAINE."medias/souvenir/".$photos[$i]."\" alt=\"Photo de ".$obj->getTitreArticle()."\">
                                <ul class=\"menu-photo\">
                                    <li class=\"checked\"><i class=\"fas fa-chevron-down\"></i>
                                        <ul class=\"chec d-none\">
                                            
                                            <li><a href=\"ami-signaler-photo-".$crypted_id_photo."\" title=\"Signaler la photo\" ><i class=\"fas fa-exclamation\"></i>
                                            </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>";
                        }
                        echo "</div>";
                
                    }
                    $visible = $obj->getActifArticle();
                    if($visible == 1){
                        $vi = "<i class=\"fas fa-eye\"></i>";
                    }else{
                        $vi = "<i class=\"fas fa-eye-slash\"></i>";
                    }
                  
                    echo "<p class=\"year\">souvenir ";
                    if($article["commun"][0] == 1){
                        echo "commun ";
                    }
                    echo" de ".$year."</p>";
                    if(!empty($article["commentaires"])){
                        echo"<section class=\"commentaires-users\">                                
                                <p class=\"btncom\">
                                    <i class=\"fas fa-chevron-down\"></i>
                                </p>
                                <div class=\"containerCom d-none\">";

                        foreach ($article["commentaires"] as $commentaire) {
                            $idAuteur = $commentaire->id_user; //variable public interogation
                            //avatar de la personne
                            if(is_null($commentaire->avatar_user)){
                                $avatar = "avatar-picmento.png";
                            }else{
                                $avatar = $commentaire->avatar_user;
                            }
                            //nom de la personne
                            if((is_null($commentaire->pseudo_user))||(empty($commentaire->pseudo_user))) {
                            $nom = $commentaire->prenom_user;
                            }else{
                            $nom = $commentaire->pseudo_user;
                            }
                            
                            echo"<div id=\"com".$commentaire->getIdCommentaire()."\" class=\"commentaires\">
                                    <div class=\"fc\">
                                        <div class=\"avatar-rond\">
                                            <img src=\"".DOMAINE."medias/avatar/".$avatar."\" alt=\"Photo de ".$nom."\">
                                        </div>
                                        <p class=\"auteur-com\">".$nom."</p>
                                    </div>
                                    <p class=\"text-com\">".$commentaire->getDescriptionCommentaire()."</p>
                                    <p class=\"gestion-com fc fw\">";
                                    if($idAuteur == $_SESSION["auth"]["id"]){
                                        
                                        echo "
                                        <a href=\"ami-editer-commentaire-".$commentaire->getIdCommentaire()."-".$result["baby"]->getIdBaby()."\" title=\"Modifier le commentaire\">
                                        <i class=\"fas fa-pen-square\"></i>
                                        </a>
                                        <a href=\"ami-supprimer-commentaire-".$commentaire->getIdCommentaire()."-".$result["baby"]->getIdBaby()."\" title=\"Supprimer le commentaire\" class=\"gogo\" data-gogo=\"le commentaire\">
                                        <i class=\"fas fa-trash\"></i>
                                        </a>";
                                    }else{
                                        $crypted_id_com = $cryptor->encrypt($commentaire->getIdCommentaire());
                                        echo "
                                        <a href=\"ami-signaler-commentaire-".$crypted_id_com."\" title=\"Signaler le commentaire\">
                                            <i class=\"fas fa-exclamation\"></i>
                                        </a>";
                                    }
                                echo " </p> 
                            </div>";// fin div commentaire
                    }
                        echo"</div> 
                        </section>";
                    }

                    $crypted_id_souvenir = $cryptor->encrypt($obj->getIdArticle());
                    
                echo"
                    <div class=\"menu-article\">
                        <ul>
                            <li>
                                <a href=\"ami-ajouter-commentaire-souvenir-".$obj->getIdArticle()."-".$result["baby"]->getIdBaby()."\" title=\"Ajouter un commentaire\">
                                    <i class=\"fas fa-comment-alt\"></i>
                                </a>
                            </li>

                            <li>
                                <a href=\"ami-signaler-souvenir-".$crypted_id_souvenir."\" title=\"Signaler le souvenir\" ".$obj->getTitreArticle()."\">
                                    <i class=\"fas fa-exclamation\"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </article>";
            
        
        }
        echo "</section>
        <a href=\"#top\" title=\"Retour en haut de page\" class=\"btn-top\">
                <i class=\"fas fa-angle-double-up\"></i>
        </a>";
}
?>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/back/js/menuPhoto.js" defer></script>
<script src="templates/front/js/visuFeedback.js" defer></script>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/back/js/scrollTop.js" defer></script>
<script src="templates/back/js/affichageCommentaire.js" defer></script>

