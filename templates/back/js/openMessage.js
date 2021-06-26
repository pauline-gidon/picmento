
///////modale message



//je selection tout mes block messages pour les rendre display none en leur ajoutant la class
const filous = document.querySelectorAll('.filou');

for(let filou of filous ){
    filou.classList.add('d-none');
    filou.onclick = function() {
        this.classList.add('d-none');
      }
}


filous.forEach(el => {
    el.addEventListener('click', (e) => {
        if(!e.target.classList.contains('.filou'))
        el.classList.add('d-none');
        });
});

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
        // el.children[2].classList.add('d-none');
        if(!e.target.classList.contains('.filou'))
        document.querySelectorAll('.filou').forEach(el => {
            el.classList.add('d-none');
        })
        e.stopPropagation();
        
        el.children[2].classList.toggle('d-none');
        el.children[1].classList.remove('messageNonLu');
        el.children[1].classList.add('messageLu');
    });
});
document.querySelectorAll('.closeMessage').forEach(el => {

    el.addEventListener('click', (e) => {
        // el.children[2].classList.add('d-none');
        if(!e.target.classList.contains('.filou'))
        document.querySelectorAll('.filou').forEach(el => {
            el.classList.add('d-none');
        })
        e.stopPropagation();
    });
});

