<?php

if(isset($_SESSION["ami"]["id"])){
    echo " 
                <a href=\"amis-voir-tribu-".$_SESSION["ami"]["id"]."\" title=\"Retour au tribus de mon ami\" class=\"btn-tribu-ami\">
                    <i class=\"fas fa-undo-alt\"></i> Tribus ami
                </a>
            ";
}
if(isset($result)){
    $date = new DateTime($result->getDateNaissanceBaby());
    
    $mois = $date->format("m");
    $jour = $date->format("d");
    $year = $date->format("Y");
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
    $mois = array_search($mois,$tableauDeMois);
    $poids = number_format($result->getPoidsNaissanceBaby(),3);
    $poids = str_replace('.','Kg',$poids);
    $heure = new DateTime($result->getHeureNaissanceBaby());
    $heure = str_replace(':','H',$heure->format("H:i"));

    // <img src=\"".DOMAINE."medias/photo-baby/".$result->getPhotoBaby()."\" alt=\"photo de ".$result->getNomBaby()."\">
  
    echo    "<section class=\"fc jc-c ai-c wrap\">
                <div>
                    <p> La naissance de <span class=\"spnaissance\">".$result->getNomBaby()."</span> est arrivée le <span class=\"spnaissance\">".$jour." ".$mois."</span>, en <span class=\"spnaissance\">".$year."</span> dans la ville de&nbsp;<span class=\"spnaissance\">".$result->getLieuNaissanceBaby()."</span>.</p>
                    <p>C'était <span class=\"spnaissance\">".$heure."</span>, son poids était de <span class=\"spnaissance\">".$poids."</span> et sa taille de <span class=\"spnaissance\">".$result->getTailleNaissanceBaby()."&nbsp;Cm</span>.</p>
                </div>
    
    
    </section>";
    

}