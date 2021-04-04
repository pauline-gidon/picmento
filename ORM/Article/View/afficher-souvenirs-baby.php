<?php
use Vendors\Flash\Flash;
$flash = new FLash();
echo $flash->getFlash();
// echo $flash->getFlash();
if(isset($result)){

    echo "<h2 class\"prenom-title\">".$result[0]->getNomBaby()."</h2>
          <p class=\"add-souvenir\"><a href=\"ajouter-souvenir-".$result[0]->getIdBaby()."\" title=\"Ajouter un souvenir à ".$result[0]->getNomBaby()." \">
            <i class=\"ico icofont-memorial\"></i> Ajouter un souvenir
            </a></p>";
    // var_dump($result[1]);die();




if(isset($result[1])){
    // var_dump($result[1]);

    echo "<section class=\"fc fw wrap\">";
    foreach($result[1] as $obj) {
            $photos = explode("/",$obj->liste_photo);
            $ids = explode("/",$obj->liste_id);
            
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
                        echo"<div class=\"fc fw jc-c\">";
                    for ($i=0; $i < count($ids); $i++) { 
                        echo "<div class=\"souv-carre\">
                                <img src=\"".DOMAINE."medias/souvenir/".$photos[$i]."\" alt=\"Photo de ".$obj->getTitreArticle()."\">
                                <ul class=\"menu-photo\">
                                    <li class=\"checked\"><i class=\"fas fa-chevron-down\"></i>
                                        <ul class=\"chec\">
                                        <li><a href=\"editer-souvenir-photo-".$ids[$i]."-".$result[0]->getIdBaby()."\" title=\"Modifier la photo\"><i class=\"fas fa-pen-square\"></i></a></li>
                                        <li><a href=\"supprimer-souvenir-photo-".$ids[$i]."-".$result[0]->getIdBaby()."\" title=\"Supprimer la photo\" class=\"gogo\" data-gogo=\"la photo\"><i class=\"fas fa-trash\"></i></a></li>
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
            
                </article>
                
            <div class=\"menu-article\">
            <ul>
                <li>
                    <a href=\"editer-souvenir-".$obj->getIdArticle()."\" title=\"Modifier l'article : ".$obj->getTitreArticle()." \">
                    <i class=\"fas fa-edit\"></i>
                    </a>
                </li>
                <li>
                    <a href=\"ajouter-une-photo-".$obj->getIdArticle()."\" title=\"Ajouter une photo\">
                    <i class=\"fas fa-camera\"></i> 
                    </a>
                </li>

                <li>
                    <a href=\"signaler-souvenir-".$obj->getIdArticle()."\" title=\"Ajouter un commentaire\">
                    <i class=\"ico icofont-comment\"></i>
                    </a>
                </li>
                <li>
                    <a href=\"signaler-souvenir-".$obj->getIdArticle()."\" title=\"Visible/Invisible\">
                    ".$vi."
                    </a>
                </li>
                <li>
                    <a href=\"signaler-souvenir-".$obj->getIdArticle()."\" title=\"Signaler l'article : ".$obj->getTitreArticle()." \">
                    <i class=\"fas fa-bell\"></i>
                    </a>
                </li>
                <li>
                    <a href=\"supprimer-souvenir-".$obj->getIdArticle()."\" title=\"Supprimer l'article\" class=\"gogo\" data-gogo=\"".$obj->getTitreArticle()."\">
                            <i class=\"fas fa-trash\"></i>
                    </a>
                </li>





            </ul>
        </div>";
            }
        
        echo "</section>";
    }
}
?>
<script type="text/javascript" src="templates/back/js/confirmation.js"></script>
