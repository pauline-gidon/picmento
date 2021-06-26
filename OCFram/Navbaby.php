<?php 
namespace OCFram;


 function prefixUrl(){
    // var_dump($_SERVER['REDIRECT_URL']);die();
    if (preg_match('|(.*)/ami(s?)(.*)|', $_SERVER['REDIRECT_URL'], $matches)) {
        return 'ami-';
    }
        
}
trait Navbaby {

    function navConstruction(Array $babys){

        echo "<nav class=\"trait-baby\">
                <ul>
                    <li class=\"menu-baby\">Enfant <i class=\"fas fa-caret-down\"></i> 
                        <ul class=\"nv2 d-none\">";
        foreach($babys as $baby) {
            echo "<li class=\"trait-nom-baby\">".$baby->getNomBaby()." <i class=\"fas fa-caret-right\"></i>
                    <ul class=\"nv3 d-none fc fw\">
                        <li><a href=\"".prefixUrl()."afficher-souvenirs-".$baby->getIdBaby()."\">Souvenir</a></li>
                        <li><a href=\"".prefixUrl()."afficher-timeline-".$baby->getIdBaby()."\">Timeline</a></li>
                        <li><a href=\"".prefixUrl()."afficher-naissance-".$baby->getIdBaby()."\">Naissance</a></li>
                    </ul>
                
                </li>";
        }
        echo "</ul>
            </li>
            </ul>
         </nav>";




        
        }
    }
