// je selection mon containner

const slider = document.querySelector(".galerie");
let isdown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown',(e) => {
    isdown= true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});

slider.addEventListener('mouseleave',() => {
    isdown= false;
    slider.classList.remove('active');
    
});

slider.addEventListener('mouseup',() => {
    isdown= false;
    slider.classList.remove('active');
    
});

slider.addEventListener('mousemove',(e) => {
    if(!isdown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3;
    slider.scrollLeft = scrollLeft - walk;
});

