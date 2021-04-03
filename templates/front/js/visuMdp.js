// POUR CIBLER LE BON INPUT? JE VAIS ICI TOUJOURS CIBLER  
// LA MEME CLASSE AU SENS CSS(.aide-mdp)
// DIT AUTREMENT, MON WIDGET NE FONCTIONNERA QU'AVEC LES ELEMENTS HTML 
// QUI ON LA CLASSE .aide-mdp
$(function(){
    //INITIALEMENT
    $('.aide-mdp').parent().css({position: 'relative'});
    $('.aide-mdp').after('<i class="fas fa-eye visu-mdp"></i>');

    //AFFICHAGE / MASQUAGE DU MOT DE PASSE
    //$('.visu-mdp').click(function(){}); ne marcherai pas car au chargement du DOM il n'existait pas je l'ai crée artificiellement
    $('.visu-mdp').css({
      position : 'absolute',
      cursor: 'pointer'
    });
    $('.visu-mdp').on('click', function(){
      $(this).toggleClass('fa-eye');
      $(this).toggleClass('fa-eye-slash');

      if($(this).hasClass('fa-eye-slash')){
        $('.aide-mdp').attr('type','text');
    }else{
          $('.aide-mdp').attr('type','password');
      }

    });
    

});