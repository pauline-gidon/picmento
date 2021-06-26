document.querySelector('body').addEventListener('change',function(e){
    let nav = document.querySelector("nav");
    let display = getComputedStyle(nav).display;
    let img = document.querySelector("#imgBandeau");
    if (display == "block"){
        img.style.marginTop = "50px";
    }else{
        
        img.style.marginTop = "0";
    }

});
