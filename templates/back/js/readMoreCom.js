let page = 1;
 
async function getImages() {
    const images = await fetch(`https://picsum.photos/v2/list?page=${page}&limit=16`);
    const data = await images.json();
    console.log(data); // On obtient un tableau de 16 images
 
    data.forEach(img => {
        let item = document.createElement('div');
        item.classList.add('item');
        item.innerHTML = `
            <img src="${img.download_url}" alt="${img.author}">
            <h2>${img.author}</h2>
        `;
        document.querySelector('#insta').appendChild(item);
    });
 
    page++;
}
 
getImages();
 
window.addEventListener('scroll', () => { //écriture fonction fléchée (pas de paramètres pour la fonction)
 
    // console.log(document); // pour voir les scroll top (où je suis), height... de document
 
    // let scrollTop = document.documentElement.scrollTop;
    // let scrollHeight = document.documentElement.scrollHeight;
    // let clientHeight = document.documentElement.clientHeight;
    //Concept de destructuration :
    const {scrollTop, scrollHeight, clientHeight} = document.documentElement;
 
    console.log(scrollTop, scrollHeight, clientHeight);
 
    if (clientHeight + scrollTop >= scrollHeight -30) {
        getImages();
    }
 
})