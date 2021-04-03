<?php 
namespace OCFram;


trait Navbaby {

    function navConstruction(Array $babys){

        echo "<nav class=\"trait-baby\">
                <ul>
                    <li><i class=\"fas fa-caret-down\"></i> Enfant
                        <ul class=\"nv2\">";
        foreach($babys as $baby) {
            echo "<li class=\"trait-nom-baby\"><i class=\"fas fa-caret-left\"></i> ".$baby->getNomBaby()."
                    <ul class=\"nv3\">
                        <li><a href=\"afficher-souvenirs-".$baby->getIdBaby()."\">Souvenir</a></li>
                        <li><a href=\"afficher-timeline-".$baby->getIdBaby()."\">Timeline</a></li>
                        <li><a href=\"afficher-naissance-".$baby->getIdBaby()."\">Naissance</a></li>
                        <li><a href=\"afficher-diaporama-".$baby->getIdBaby()."\">Diaporama</a></li>
                    </ul>
                
                </li>";
        }
        echo "</ul>
            </li>
            </ul>
         </nav>";




        
        }
    }
