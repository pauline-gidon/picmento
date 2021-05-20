// faire apparaitre la liste des nom d'enfant
     const navBaby = document.querySelector('.menu-baby');
     let menuBaby = navBaby.children[1];
     navBaby.addEventListener('click', (e) => {
         menuBaby.classList.toggle('d-none');
        });
        
// faire displaraitre les ancien element cliker
    document.querySelector('body').addEventListener('click',function(e){
        if(!e.target.classList.contains('.trait-nom-baby'))
        document.querySelectorAll('.nv3').forEach(el => {
            el.classList.add('d-none');
        })

    })

// faire apparaitre les services lié à l'enfant ex timeline...
    document.querySelectorAll('.trait-nom-baby').forEach(el => {
        el.addEventListener('click', (e) => {
            document.querySelectorAll('.nv3').forEach(el => {
                el.classList.add('d-none');
            })
            e.stopPropagation();
            el.children[1].classList.remove('d-none');
        });
    });
