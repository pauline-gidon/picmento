

//methos ajax pour message lu au click



const resultat = document.querySelector('#result');

//Function
function messageLu(id){
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            // alert("ok lu");
        }
    }
    id = encodeURIComponent(id);
    // xhr.open('GET','traitement.php?s='+id,true);
    // xhr.send();
    xhr.open('POST','message-lu',true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send('s='+id);
    //plusieur valeur a passer  : xhr.send('s='+saisie+'&v='+ville+'$autre='+other);


}
// -------------------------------------------------------------------------


//Ciblage and event
document.querySelectorAll('.message-recu').forEach(el => {
    el.addEventListener('click', function(){
        messageLu(this.getAttribute('data-id'));
    });
});
