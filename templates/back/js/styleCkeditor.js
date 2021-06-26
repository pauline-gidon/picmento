    // je cible le textearea
    let textarea = document.querySelector('textarea');
    // je cible son parent
    let parentTextarea = document.querySelector("textarea").parentNode;
    // je crée une div en lui ajouter les propriété css voulu (class champ)
    let div = document.createElement("div");
    div.classList.add("champW");
    // j'ajoute la div au parent du textarea en le placent devant le text
    parentTextarea.insertBefore(div, textarea);
    // je deplace le text area dans la div
    div.appendChild(textarea);


