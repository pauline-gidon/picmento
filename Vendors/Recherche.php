<?php 
namespace Vendors;


trait Recherche {

    function Rechercher(){

        echo "<div class=\"zoneRecherche\">
                <input id=\"rech\"type=\"text\" name=\"rech\" class=\"champRecherche\" placeholder=\"Recherche...\">
                <i class=\"fas fa-search\"></i>
                <div id=\"result\">
                </div>
            </div>";




        
        }
    }
