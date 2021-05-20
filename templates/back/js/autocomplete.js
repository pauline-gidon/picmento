     //Ciblage
     const input = document.querySelector('.champRecherche');
     const resultDiv = document.querySelector("#result");


     //Function
     function autocomplete(saisie){
         const xhr = new XMLHttpRequest();

         xhr.onreadystatechange = function(){
             if(xhr.readyState == 4 && xhr.status == 200){
                result = JSON.parse(xhr.responseText);
                resultDiv.innerHTML += result.value;
                    // alert('cc');
             }
         }
         saisie = encodeURIComponent(saisie);
         // xhr.open('GET','traitement.php?s='+saisie,true);
         // xhr.send();
         xhr.open('POST','autocomplete',true);
         xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
         xhr.send('s='+saisie);
         //plusieur valeur a passer  : xhr.send('s='+saisie+'&v='+ville+'$autre='+other);


     }

     // Events
     input.addEventListener('keyup', function(){
         autocomplete(this.value);
         console.log(this.value);
     });


//     //  1354vd5s3<1vg6dsf1vg6<szb8rf<f6<


	
// // getting all required elements
// const searchWrapper = document.querySelector(".search-input");
// const inputBox = searchWrapper.querySelector("input");
// const suggBox = searchWrapper.querySelector(".autocom-box");
// const icon = searchWrapper.querySelector(".icon");
// let linkTag = searchWrapper.querySelector("a");
// let webLink;
 
// // if user press any key and release
// inputBox.onkeyup = (e)=>{
//     let userData = e.target.value; //user enetered data
//     let emptyArray = [];
//     if(userData){
//         icon.onclick = ()=>{
//             webLink = "https://www.google.com/search?q=" + userData;
//             linkTag.setAttribute("href", webLink);
//             console.log(webLink);
//             linkTag.click();
//         }
//         emptyArray = suggestions.filter((data)=>{
//             //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
//             return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase()); 
//         });
//         emptyArray = emptyArray.map((data)=>{
//             // passing return data inside li tag
//             return data = '<li>'+ data +'</li>';
//         });
//         searchWrapper.classList.add("active"); //show autocomplete box
//         showSuggestions(emptyArray);
//         let allList = suggBox.querySelectorAll("li");
//         for (let i = 0; i < allList.length; i++) {
//             //adding onclick attribute in all li tag
//             allList[i].setAttribute("onclick", "select(this)");
//         }
//     }else{
//         searchWrapper.classList.remove("active"); //hide autocomplete box
//     }
// }
 
// function select(element){
//     let selectData = element.textContent;
//     inputBox.value = selectData;
//     icon.onclick = ()=>{
//         webLink = "https://www.google.com/search?q=" + selectData;
//         linkTag.setAttribute("href", webLink);
//         linkTag.click();
//     }
//     searchWrapper.classList.remove("active");
// }
 
// function showSuggestions(list){
//     let listData;
//     if(!list.length){
//         userValue = inputBox.value;
//         listData = '<li>'+ userValue +'</li>';
//     }else{
//         listData = list.join('');
//     }
//     suggBox.innerHTML = listData;
// }