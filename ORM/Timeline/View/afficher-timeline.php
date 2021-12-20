<?php
use Vendors\Cryptor;
use Vendors\Flash\Flash;

$flash = new Flash();
$cryptor = new Cryptor();


echo "<h2>".$result["baby"]->getNomBaby()."</h2>
        <p class=\"btnaddtimeline\">
            <a href=\"ajouter-timeline-".$result["baby"]->getIdBaby()."\" title=\"Ajouter une photo à la timeline de ".$result["baby"]->getNomBaby()."\">
                <i class=\"fas fa-plus\"></i>
                <span>Ajouter une photo</span>
            </a>
        </p>
";
echo $flash->getFlash();

echo"<div class=\"fc fw div-time\">";
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
            <div class=\"fc galerie wrap\">";


        foreach($result["timeline"] as $obj){
            // var_dump($obj);
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $mois = array_search($mois,$tableauDeMois);
            $twoYears = $babyYear + 1;
            $crypted_id_timeline = $cryptor->encrypt($obj->getIdTimeline());
                
    echo "      <div  class=\"blockTimeCarre\">
                        <div class=\"time-carre\" style=\"background-image: url(".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline().")\">
                        
                        </div>
                    
                    
                    <p class=\"dateTimeline\">".$mois." ".$annee."</p>
                    <a href=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" class=\"openPhoto\">
                        <i class=\"far fa-eye\"></i>
                     </a>
                     <a href=\"supprimer-photo-timeline-".$crypted_id_timeline."\" title=\"Supprimer la photo\" class=\"gogo trashPhoto\" data-gogo=\"la photo\"><i class=\"fas fa-trash\"></i></a>

                </div>
                ";
        }


    }
    
    echo"</div>
    <div id=\"modale\" class=\"modal d-none\">
            
            <div class=\"modal-content\">
                <img src=\"\" alt=\"image timeline picmento\">
            </div>
            <span class=\"close\"><i class=\"fas fa-times\"></i></span>
           
        </div>
    </div> 
         
    
    ";



            
}
?>

<!-- <script src="templates/back/js/showTimeline.js" defer></script> -->
<script src="templates/back/js/modalePhoto.js" defer></script>
<script src="templates/back/js/scrollDragDrop.js" defer></script>
<script src="templates/back/js/scrollXGalerie.js" defer></script>
<script src="templates/back/js/confirmation.js" defer></script>


<script src="templates/front/js/visuFeedback.js" defer></script>



    


