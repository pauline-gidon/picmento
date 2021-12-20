function deplace(e){
    var delta = 0;
    if (!e) e = window.event;
    if (e.wheelDelta) {
    delta = e.wheelDelta/120;
    } else if (e.detail) {
    delta = -e.detail/3;
    }
    if(delta<0){
    val=-100;
    }
    else{
    val=100;
    }
    document.querySelector('.galerie').scrollLeft=document.querySelector('.galerie').scrollLeft+val
    
    }
    
    function selecte(ev){
    (navigator.appName.substring(0,3)=="Mic") ? event.returnValue = false : ev.preventDefault();
    }
    
    
    function init(){
    
    var adi=document.querySelector('.galerie')
    if(navigator.appName.substring(0,5)=="Micro"){
    adi.attachEvent('onmousewheel',deplace);
    adi.attachEvent('onmousewheel', selecte)
    }
    else{
    if (navigator.userAgent.indexOf("Firefox") != -1){
    adi.addEventListener('DOMMouseScroll', deplace, false);
    adi.addEventListener("DOMMouseScroll", selecte, false)
    }
    else{
    adi.addEventListener('mousewheel', deplace, false);
    adi.addEventListener("mousewheel", selecte, false)
    }
    }
    }
    onload=init 
    