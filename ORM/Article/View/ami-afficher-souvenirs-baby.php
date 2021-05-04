<?php
use Vendors\Flash\Flash;
$flash = new FLash();
echo $flash->getFlash();
// echo $flash->getFlash();
//$general[0]= baby
echo "<h2 class\"prenom-title\">".$result["baby"]->getNomBaby()."</h2>
      <p class=\"add-souvenir\"><a href=\"ajouter-souvenir-".$result["baby"]->getIdBaby()."\" title=\"Ajouter un souvenir à ".$result["baby"]->getNomBaby()." \">
        <i class=\"ico icofont-memorial\"></i> Ajouter un souvenir
        </a></p>";

if(isset($result["articles"])){
    echo "<section class=\"fc fw wrap\">";
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
                echo "<article class=\"article-baby\">
                        <h1 class=\"title\">".$obj->getTitreArticle()."</h1>
                        <p class=\"description\">".$obj->getDescriptionArticle()."</p>
                    <div class=\"ruban-date\"><p>".$jour."</p><p>".$mois."</p></div>";
                    if(!is_null($obj->liste_photo)){
                        $photos = explode("/",$obj->liste_photo);
                        $ids = explode("/",$obj->liste_id);
            
                        echo"<div class=\"fc fw jc-c\">";
                    for ($i=0; $i < count($ids); $i++) { 
                        echo "<div class=\"souv-carre\">
                                <img src=\"".DOMAINE."medias/souvenir/".$photos[$i]."\" alt=\"Photo de ".$obj->getTitreArticle()."\">
                                <ul class=\"menu-photo\">
                                    <li class=\"checked\"><i class=\"fas fa-chevron-down\"></i>
                                        <ul class=\"chec\">
                                        <li>
                                            <a href=\"signaler-souvenir-photo-".$ids[$i]."-".$result["baby"]->getIdBaby()."\" title=\"signaler la photo\">
                                                <i class=\"fas fa-bell\"></i>
                                            </a>
                                        </li>
                                        
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
                    echo "<p>".$year."</p>
                    <div>";
                    
                    foreach ($article["commentaires"] as $commentaire) {
                        if(!is_null($commentaire->pseudo_user)){
                            $nom = $commentaire->pseudo_user;
                        }else{
                            $nom = $commentaire->prenom_user." ".$commentaire->nom_user;
                        }
                        echo"<p>Ecrit par : ".$nom."</p>
                            <p>".$commentaire->getDescriptionCommentaire()."</p>
                            <p>
                                <a href=\"ami-editer-commentaire-".$commentaire->getIdCommentaire()."-".$result["baby"]->getIdBaby()."\" title=\"Modifier le commentaire\">
                                <i class=\"fas fa-pen-square\"></i>
                                </a>
                                <a href=\"ami-supprimer-commentaire-".$commentaire->getIdCommentaire()."-".$result["baby"]->getIdBaby()."\" title=\"Supprimer le commentaire\" class=\"gogo\" data-gogo=\"le commentaire\">
                                <i class=\"fas fa-trash\"></i>
                                </a>
                                <a href=\"signaler-commentaire-souvenir-".$obj->getIdArticle()."-".$result["baby"]->getIdBaby()."\" title=\"Signaler un commentaire\">
                                <i class=\"fas fa-bell\"></i>
                                </a>
                            </p>
                  
                            
                            ";
                    } 

                echo"</div>
                </article>
                
            <div class=\"menu-article\">
            <ul>
 

                <li>
                    <a href=\"ami-ajouter-commentaire-souvenir-".$obj->getIdArticle()."-".$result["baby"]->getIdBaby()."\" title=\"Ajouter un commentaire\">
                    <i class=\"ico icofont-comment\"></i>
                    </a>
                </li>
                <li>
                    <a href=\"signaler-souvenir-".$obj->getIdArticle()."-".$result["baby"]->getIdBaby()."\" title=\"Signaler un souvenir\">
                    <i class=\"fas fa-bell\"></i>
                    </a>
                </li>

            </ul>
        </div>";
            
        
        }
        echo "</section>";
}
?>
<script type="text/javascript" src="templates/back/js/confirmation.js"></script>
