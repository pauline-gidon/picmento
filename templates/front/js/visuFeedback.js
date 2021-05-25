// je veux faire disparaitre les feedback au bout de 8 secondes
//je met un ecouteur sur le body
// quand il change je selection le feedback
//si il le trouve j'active la fonction qui ajoute la classe d-none a l'élément au bout de 8 seconde
function feedbackUP(){
    
    let feedback = document.querySelector('.feedback');
    if(feedback){
        setTimeout(function(){visuFeedback(feedback)},6000);
    }
}
    
function visuFeedback(el) {
    el.classList.add('d-none');
    // alert('cc');
}

feedbackUP();