
///////modale message



//je selection tout mes block messages pour les rendre display none en leur ajoutant la class
document.querySelectorAll('.filou').forEach(el => {
    el.classList.add('d-none');
})

//je met un ecouteur d'evenement sur tous le body pour referme le block message au click
document.querySelector('body').addEventListener('click',function(e){
    if(!e.target.classList.contains('.filou'))
    document.querySelectorAll('.filou').forEach(el => {
        el.classList.add('d-none');
    })

})
//je selection mes message pour leur appliquer l'ecouteur d'évènement
document.querySelectorAll('.message-recu').forEach(el => {
    el.addEventListener('click', (e) => {
        e.stopPropagation();
        el.children[2].classList.toggle('d-none');
        el.children[1].classList.remove('messageNonLu');
        el.children[1].classList.add('messageLu');
    });
});

