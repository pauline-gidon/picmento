<?php
use Vendors\Flash\Flash;
$flash = new FLash();
echo $flash->getFlash();


if(isset($result)){
    echo "<section id=\"top\" class=\"fc fw wrap\">";
    foreach($result as $obj){
        
        
        $date = new DateTime($obj["article"]->getDateArticle());
        
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
                $nomsBaby = explode("/",$obj["article"]->liste_nom_baby);
                $photosBaby = explode("/",$obj["article"]->liste_photo_baby);

                echo "<div class=\" proposotion-souvenir\">
                        <p>                
                            ".$obj["auteur"][0]->getPrenomUser()." ".$obj["auteur"][0]->getNomUser()." vous propose se souvenir pour le(s) album(s) de :
                        </p>
                      
        
                        <div class=\"fc fw ai-c\">";
                        //pour l'afffichage des photos
                        for ($i=0; $i < count($photosBaby); $i++) { 
                            echo "<div class=\"containerBull\">
                                    <div class=\"bulleBaby\">
                                        <img src=\"".DOMAINE."medias/photo-baby/".$photosBaby[$i]."\" alt=\"Photo de ".$nomsBaby[$i]."\">
                                    </div>
                                    <p>".$nomsBaby[$i]."</p>
                                </div>";
                            }
    
                echo "</div> 
             
                    
                    <article id=\"ancre-".$obj["article"]->getIdArticle()."\" class=\"article-baby\">
                        <h1 class=\"title\">".ucfirst($obj["article"]->getTitreArticle())."</h1>
                        <p class=\"description\">".ucfirst($obj["article"]->getDescriptionArticle())."</p>
                        <p class=\"ruban-date solide\"><span>".$jour."</span><br>".$mois."</p>";
                    if(!is_null($obj["article"]->liste_nom_photo)){
                        $photos = explode("/",$obj["article"]->liste_nom_photo);
                        $ids = explode("/",$obj["article"]->liste_id_photo);
            
                        echo"<div class=\"fc fw jc-c\">";
                    for ($i=0; $i < count($ids); $i++) { 
                        echo "<div class=\"souv-carre\">
                                <img src=\"".DOMAINE."medias/souvenir/".$photos[$i]."\" alt=\"Photo de ".$obj["article"]->getTitreArticle()."\">
                            </div>";
                        }
                        echo "</div>";
                
                    } //fin du if photo
                  
                    echo "<p class=\"year\">souvenir de ".$year."</p>
                    
                    <div class=\"menu-article-proposer\">
                            <ul>
                                <li>
                                    <a href=\"accepter-souvenir-proposer-".$obj["article"]->getIdArticle()."\" title=\"Accepter la proposition de souvenirs : ".$obj["article"]->getTitreArticle()." \">
                                        <i class=\"fas fa-check-square\"></i>
                                    </a>
                                </li>
                                    
                                <li>
                                    <a href=\"supprimer-souvenir-proposer-".$obj["article"]->getIdArticle()."\" title=\"refusé le souvenir\" class=\"gogo\" data-gogo=\"".$obj["article"]->getTitreArticle()."\">
                                        <i class=\"fas fa-window-close\"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </article>
                </div>";
            
        
        }// fin du foreach des souvenir
        echo "</section>
        <a href=\"#top\" title=\"Retour en haut de page\" class=\"btn-top\">
                <i class=\"fas fa-angle-double-up\"></i>
        </a>";
}
?>
<script src="templates/back/js/confirmation.js" defer></script>
<script src="templates/back/js/menuPhoto.js" defer></script>
