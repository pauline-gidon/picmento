<?php 
namespace Vendors;


trait Recherche {

    function Rechercher(){

        echo "<div class=\"zoneRecherche fc fw\">
                <input id=\"rech\"type=\"text\" name=\"rech\" class=\"champRecherche\" placeholder=\"Recherche...\">
                <i class=\"fas fa-search\"></i>
                
                
                <select name=\"sources\" id=\"sources\" class=\"custom-select sources\" placeholder=\"Titre\">
                    <option value=\"titre\" selected>Titre</option>
                    <option value=\"annee\">Année</option>
                </select>
                
  
                <div id=\"result\">
                </div>
            </div>";




        
        }
    }
