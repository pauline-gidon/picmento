        document.querySelector('body').addEventListener('click',function(e){
            if(!e.target.classList.contains('.checked'))
            document.querySelectorAll('.chec').forEach(el => {
                el.classList.add('d-none');
            })

        })
     document.querySelectorAll('.checked').forEach(el => {
         el.addEventListener('click', (e) => {
            document.querySelectorAll('.chec').forEach(el => {
                el.classList.add('d-none');
            })
            e.stopPropagation();
            el.children[1].classList.toggle('d-none');
        });
    });

