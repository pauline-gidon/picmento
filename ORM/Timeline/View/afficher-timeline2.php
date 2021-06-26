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
    var_dump("naissance baby ".$babyYear." ".$babyMonth);

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
            <div id=\"masque\" class=\"wrap\">
                
            <div class=\"containerYearTimeline\">Avant la naissance</div>";


        foreach($result["timeline"] as $obj){
            // var_dump($obj);
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $mois = array_search($mois,$tableauDeMois);
            $twoYears = $babyYear + 1;
            if($annee < $babyYear || $annee == $babyYear && $mois < $babyMonth){
                
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            <div class=\"dateTimeline\">".$mois." ".$annee."</div>
                            ";
    
            }
    
                       
        }
                echo"<div class=\"containerYearTimeline\">De la naissance à 1 an</div>";
    
        foreach($result["timeline"] as $obj){
            // var_dump($obj);
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $mois = array_search($mois,$tableauDeMois);

            $twoYears = $babyYear + 1;
            if(($annee >= $babyYear && $mois >= $babyMonth) && ($annee < $twoYears)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            <div class=\"dateTimeline\">".$mois." ".$annee."</div>

                            ";
    
            }
    
                       
        }
        echo"<div class=\"containerYearTimeline\">De 1 an à 2 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $threeYear = $babyYear + 2;
            if(($annee == $twoYears || $annee < $threeYear && $annee > $twoYears)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 2 ans à 3 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $fourYear = $babyYear + 3;
            if(($annee == $threeYear || $annee < $fourYear && $annee > $threeYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 3 ans à 4 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $fiveYear = $babyYear + 4;
            // var_dump('dd');
            if(($annee == $fourYear || $annee < $fiveYear && $annee > $fourYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 4 ans à 5 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $sixYear = $babyYear + 5;
            if(($annee == $fiveYear || $annee < $sixYear && $annee > $fiveYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 5 ans à 6 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $septYear = $babyYear + 6;
            if(($annee == $septYear || $annee < $septYear && $annee > $sixYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 6 ans à 7 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $heightYear = $babyYear + 7;
            if(($annee == $heightYear || $annee < $heightYear && $annee > $septYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 7 ans à 8 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $nineYear = $babyYear + 8;
            if(($annee == $nineYear || $annee < $nineYear && $annee > $heightYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 8 ans à 9 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $tenYear = $babyYear + 9;
            // var_dump($obj->getIdTimeline());
            if(($annee == $tenYear || $annee < $tenYear && $annee > $nineYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
                            
    
            }
        }
        echo"<div class=\"containerYearTimeline\">De 9 ans à 10 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            $elevenYear = $babyYear + 10;
            if(($annee == $elevenYear || $annee < $elevenYear && $annee > $tenYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"<div class=\"containerYearTimeline\">Après 10 ans</div>";
        foreach($result["timeline"] as $obj){
            $annee = $obj->getAnneePhotoTimeline();
            $mois = $obj->getMoisPhotoTimeline();
            if(($annee > $tenYear)){
                echo "      <div class=\"time-carre\">
                                <img src=\"".DOMAINE."medias/timeline/".$obj->getNomPhotoTimeline()."\" alt=\"\">
                            </div>
                            ";
    
            }
        }
        echo"</div> ";
    }



            
}
?>

<script src="templates/back/js/showTimeline.js" defer></script>
<script src="templates/front/js/visuFeedback.js" defer></script>


    


