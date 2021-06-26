
    


    //il faut que j'aille cherche en bdd avec ajax la date du souvenir le plus récent Desc et la date du souvenir le plus ancien ASC
    // j'ai donc deux requette  de la date la plus ancienne doit etre inserer à la valeur au range min
    // et la quette de la date la plus recent doit etre inserer a la valeur max du range et mettre les meme valeur pour value 0 et 1
    $.ajax({
        type: 'POST',
        url: 'range-year',
        success: function(resultat){
            $("#slider-range").slider({
                min: resultat,
                max: resultat,
                values : resultat,
                select: function(event, ui){
                    $("#zorro").val(ui.item.id);
                    console.log(ui.item.id);
                }
            });
        }
    });




    $( "#slider-range" ).slider({
    range: true,
    min: 2014,
    max: 2020,
    values: [ 2014, 2020 ],
    slide: function( event, ui ) {
    $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
    }
    });
    //les
    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
    " - " + $( "#slider-range" ).slider( "values", 1 ) );

    






