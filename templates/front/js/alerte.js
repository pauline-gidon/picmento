
    //INITIALEMENT
    $('.alerte').parent().css({position: 'relative'});
    $('.alerte').css({position: 'absolute'});

    // //AFFICHAGE / MASQUAGE DU MOT DE PASSE
    // //$('.visu-mdp').click(function(){}); ne marcherai pas car au chargement du DOM il n'existait pas je l'ai crée artificiellement
    // $('.visu-mdp').css({
    //   position : 'absolute',
    //   cursor: 'pointer'
    // });
    // $('.visu-mdp').on('click', function(){
    //   $(this).toggleClass('fa-eye');
    //   $(this).toggleClass('fa-eye-slash');

    //   if($(this).hasClass('fa-eye-slash')){
    //     $('.aide-mdp').attr('type','text');
    // }else{
    //       $('.aide-mdp').attr('type','password');
    //   }

    // });
    