<?php
use Vendors\Flash\Flash;
$flash = new Flash();
echo $flash->getFlash();
echo "<p class=\"btnaddtimeline\">
<a href=\"ajouter-timeline-".$result["baby"]->getIdBaby()."\" title=\"Ajouter une photo à la timeline de ".$result["baby"]->getNomBaby()."\">
<i class=\"fas fa-plus\"></i>
<span>Ajouter une photo</span>
</a>
</p>";


if(isset($result["baby"])){
    $datebaby = $result["baby"]->getDateNaissanceBaby();
    $datebaby = explode("-", $datebaby);
    $babyYear = $datebaby[0];
    $babyMonth = $datebaby[1];
    // var_dump("naissance baby ".$babyYear." ".$babyMonth);

    if(isset($result["timeline"])) {
        $tableauDeMois= [
            'Janvier'=> '01',
            'Février'=> '02',
            'Mars'  =>  '03',
            'Avril' => '04',
            'Mai'   => '05',
            'Juin'  =>  '06',
            'Juillet' => '07',
            'Aout' => '08',
            'Septembre' => '09',
            'Octobre' => '10',
            'Novembre' => '11',
            'Décembre' => '12'    
            
        ];
        echo"
            <div class=\"fc fw jc-c galerie wrap\">";


        foreach($result["timeline"] as $obj){
            // var_dump($obj);
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $mois = array_search($mois,$tableauDeMois);
            $twoYears = $babyYear + 1;
            
                
    echo "      <div  class=\"blockTimeCarre\">
                    <a href=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" class=\"time-carre\">
                        <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"image timeline de ".$result["baby"]->getNomBaby()." \">
                    </a>
                    <p class=\"dateTimeline\">".$mois." ".$annee."</p>
                </div>
                ";
        }


        echo"<div id=\"modale\" class=\"modal d-none\">
                
                <div class=\"modal-content\">
                    <img src=\"\" alt=\"image timeline picmento\">
                </div>
                <span class=\"close\"><i class=\"fas fa-times\"></i></span>
            </div>
        </div> 
             
        
        ";
    }



            
}
?>

<script src="templates/back/js/showTimeline.js" defer></script>
<script src="templates/back/js/modaleTimeline.js" defer></script>

<script src="templates/front/js/visuFeedback.js" defer></script>


    


