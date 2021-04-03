// alert('toto');
document.querySelector('body').addEventListener('click',function(e){
    if(!e.target.classList.contains('.modale') && (!e.target.classList.contains('.id-baby')) )
    document.querySelectorAll('.modale').forEach(modale => {
        // modale.style.left = '-100vw';
        modale.classList.remove('open');
    })

})

document.querySelectorAll('.id-baby').forEach(el => {
    el.addEventListener('click', function(e){
        e.stopPropagation();
        let id = el.getAttribute('data-id')
        document.querySelectorAll('.modale').forEach(modale => {
            // modale.style.left = '-100vw';
            modale.classList.remove('open');
        })
        const modal = document.querySelector('div[data-id=m-'+id+']')
        modal.classList.add('open');
        modal.querySelector('.close').addEventListener('click',() => {
            modal.classList.remove('open')
        })
    })
})

document.querySelector('.modale.open').addEventListener('click', function(e){
    e.stopPropagation();
})





