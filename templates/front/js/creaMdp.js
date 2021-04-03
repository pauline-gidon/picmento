$(function(){

    //ASSISTANCE A LA CREATION DU MDP
    function affichage(){
        let message = '<ul class="messageAideMdp">';
            message += '<li>8 caractères minimum</li>';
            message += '<li>1 majuscule minimum</li>';
            message += '<li>1 minuscule minimum</li>';
            message += '<li>1 chiffre minimum</li>';
            message += '<li>1 caractères spécial minimum</li>';
            message += '</ul>';

        $('.aide-mdp').parent().after(message);
    }

    //Appel de la fonction
    affichage();

    //INTERACTION AVEC LA SAISIE DE L4INTERNAUTE
    $('.aide-mdp').keyup(function(){
        const saisie = $(this).val();

        if(saisie.length >=8) {
            $('.messageAideMdp li:nth-child(1)').addClass('barre');
        }else{
            $('.messageAideMdp li:nth-child(1)').removeClass('barre');

        }

        if(saisie.match(/(?=.*[A-Z])/)){//Expression régulière pour savoir si il y a une majuscules
            $('.messageAideMdp li:nth-child(2)').addClass('barre');

        }else{
            $('.messageAideMdp li:nth-child(2)').removeClass('barre');
        }


        if(saisie.match(/(?=.*[a-z])/)){//Expression régulière pour savoir si il y a une minuscule
            $('.messageAideMdp li:nth-child(3)').addClass('barre');

        }else{
            $('.messageAideMdp li:nth-child(3)').removeClass('barre');
        }

        if(saisie.match(/(?=.*[0-9])/)){//Expression régulière pour savoir si il y a un chiffre
            $('.messageAideMdp li:nth-child(4)').addClass('barre');

        }else{
            $('.messageAideMdp li:nth-child(4)').removeClass('barre');
        }
        
        if(saisie.match(/(?=.*\W)/)){//Expression régulière pour savoir si il y a un chiffre
            $('.messageAideMdp li:nth-child(5)').addClass('barre');

        }else{
            $('.messageAideMdp li:nth-child(5)').removeClass('barre');
        }

    });


});