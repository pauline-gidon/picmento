const modale = document.querySelector("#modale");
const close = document.querySelector(".close");
const links = document.querySelectorAll(".galerie a");
for(let link of links){
    link.addEventListener("click", function(e){

        //je desactive le comportement des liens
        e.preventDefault();
        //j'ajoute l'image du lien clicker dans la modale
        const image = modale.querySelector(".modal-content img");
        image.src = this.href;
        //j'affiche la modale
        modale.classList.remove("d-none");
    });

    // le boutton close
    close.addEventListener("click", function(){
        // alert('ss');
        modale.classList.add("d-none");
    });
    
    // fermer au click de la modale
    modale.addEventListener("click", function(){
        modale.classList.add("d-none");
    });
}