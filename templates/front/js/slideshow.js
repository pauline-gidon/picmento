$(function(){
    //Nb total d'images dans le bandeau
    const total = $('#bandeau img').length;
    //Je peux donc... en déduire la longeur du bandeau ( si 3 img alors 300%)
    const longueur = total * 100;
    //Je peux donc... en déduire la largeur ici des figures
    const largeur = 100 / total;
    //Où se trouve le bandeau initialement(en left)
    let destination = 0;
    //Au chargement de la page, je suis sur quel image
    let image = 1;

    // Etats initieux
    $('#bandeau').css({width: longueur+'%'});
    $('#bandeau figure').css({width: largeur+'%'});

    //Le click du bouton droit...
    $('#btn_droit').click(function(){
        if(image < total){
            image ++;
            destination -= 100;
            $('#bandeau').animate({left: destination +'%'},1000);
        }else{
            image = 1;
            destination = 0;
            $('#bandeau').animate({left: destination +'%'},10);
        }
    });
    // le click du btn gauche...
    $('#btn_gauche').click(function(){
        if(image > 1){
            image--;
            destination += 100;
            $('#bandeau').animate({left: destination +'%'},1000);
        }
    });
});