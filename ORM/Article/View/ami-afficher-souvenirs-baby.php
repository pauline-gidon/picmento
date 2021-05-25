<?php
use Vendors\Flash\Flash;
$flash = new FLash();
// echo $flash->getFlash();
//$general[0]= baby
if(isset($_SESSION["ami"]["id"])){
    echo " <a href=\"voir-tribu-amis-".$_SESSION["ami"]["id"]."\" title=\"Retour au tribus de mon ami\" class=\"btn-tribu-ami\">
                <i class=\"fas fa-undo-alt\"></i>&nbsp;Tribus&nbsp;ami
            </a>";
}


if(isset($result["articles"])){
    echo "<section id=\"top\" class=\"fc fw wrap\">";
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
                        <p class=\"description\">".ucfirst($obj->getDescriptionArticle())."</p>
                    <p class=\"ruban-date solide\"><span>".$jour."</span><br>".$mois."</p>";
                    if(!is_null($obj->liste_photo)){
                        $photos = explode("/",$obj->liste_photo);
                        $ids = explode("/",$obj->liste_id);
            
                        echo"<div class=\"fc fw jc-c\">";
                    for ($i=0; $i < count($ids); $i++) { 
                        echo "<div class=\"souv-carre\">
                                <img src=\"".DOMAINE."medias/souvenir/".$photos[$i]."\" alt=\"Photo de ".$obj->getTitreArticle()."\">
                                <ul class=\"menu-photo\">
                                    <li class=\"checked\"><i class=\"fas fa-chevron-down\"></i>
                                        <ul class=\"chec d-none\">
                                            
                                            <li><a href=\"signaler-photo-".$ids[$i]."-".$result["baby"]->getIdBaby()."\" title=\"Signaler la photo\" ><i class=\"fas fa-bell\"></i>
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
                        echo"<section class=\"commentaires-users\">";
                        foreach ($article["commentaires"] as $commentaire) {
                            $idAuteur = $commentaire->id_user;
                            
                            echo"<div class=\"commentaires\">
                                    <p class=\"auteur-com\">Ecrit par : ".$commentaire->pseudo_user."";
                                    if((is_null($commentaire->pseudo_user))||(empty($commentaire->pseudo_user))) {
                                        echo"".$commentaire->prenom_user."";
                                        
                                    }else{
                                        echo"".$commentaire->pseudo_user."";
                                    }
                            
                            
                                        echo"</p>
                                            <p class=\"text-com\">".$commentaire->getDescriptionCommentaire()."</p>
                                            <p class=\"gestion-com\">";
                                        if($idAuteur == $_SESSION["auth"]["id"]){
                                            echo "<a href=\"ami-editer-commentaire-".$commentaire->getIdCommentaire()."-".$result["baby"]->getIdBaby()."\" title=\"Modifier le commentaire\">
                                                    <i class=\"fas fa-pen-square\"></i>
                                                </a>
                                                <a href=\"supprimer-commentaire-".$commentaire->getIdCommentaire()."-".$result["baby"]->getIdBaby()."\" title=\"Supprimer le commentaire\" class=\"gogo\" data-gogo=\"le commentaire\">
                                                    <i class=\"fas fa-trash\"></i>
                                                </a>";
                                            }else{
                                                echo "<a href=\"signaler-commentaire-".$commentaire->getIdCommentaire()."-".$result["baby"]->getIdBaby()."\" title=\"Signaler le commentaire\">
                                                <i class=\"fas fa-bell\"></i>
                                            </a>";
                                            }
                                        echo " </p>
                                </div>";
                        }
                    
                    }
 
                echo"
                
                        <div class=\"menu-article\">
                        <ul>


                            <li>
                                <a href=\"ami-ajouter-commentaire-souvenir-".$obj->getIdArticle()."-".$result["baby"]->getIdBaby()."\" title=\"Ajouter un commentaire\">
                                <i class=\"ico icofont-comment\"></i>
                                </a>
                            </li>

                            <li>
                                <a href=\"signaler-souvenir-".$obj->getIdArticle()."-".$result["baby"]->getIdBaby()."\" title=\"Signaler le souvenir\" ".$obj->getTitreArticle()."\">
                                        <i class=\"fas fa-bell\"></i>
                                </a>
                            </li>

                        </ul>
                    </div></article>";
            
        
        }
        echo "</section>
        <a href=\"#top\" title=\"Retour en haut de page\" class=\"btn-top\">
                <i class=\"fas fa-angle-double-up\"></i>
        </a>";
}
?>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/back/js/menuPhoto.js" defer></script>
