     document.querySelectorAll(".btncom").forEach(el => {
         el.addEventListener("click", (e) => {
             let child = el.childNodes;
             let sectionCom = el.closest(".commentaires-users");
             let containerCom = sectionCom.querySelector(".containerCom")
             containerCom.classList.toggle('d-none');
        });
    });

