     //Ciblage
     let rechInput = document.querySelector(".champRecherche");
     let resultDiv = document.querySelector("#result");


     //Function
     function autocomplete(saisie){
         let xhr = new XMLHttpRequest();

         xhr.onreadystatechange = function(){
             if(xhr.readyState == 4 && xhr.status == 200){
                //  let result = xhr.responseText;
                let results = JSON.parse(xhr.responseText);
                // console.log(result);
                // resultDiv.innerHTML = result.value;
                // for (let i = 0; i < result.length; i++) {
                //     console.log("resulat:"+i);

                //     let data = result[i]+"";
                //     // data = data.replace(saisie, "<b>"+saisie+"</b>");
                //     resultDiv.innerHTML += "<div class='suggestion'>"+data.id+"</div>";
                // }
                for (let result in results) {
                    console.log("resulat:"+result);

                    let data = results[result].title+"";
                    let dataid = results[result].id+"";
                    // data = data.replace(saisie, "<b>"+saisie+"</b>");
                    resultDiv.innerHTML += "<li id='"+dataid+" class='suggestion'>"+data+"</li>";

                    
                }
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
        
        //ciblage
        let select = document.querySelector("#sources");
        let selection  = select.selectedIndex;
        console.log(selection);
        // je veut mettre une ecoute sur la selection 
        select.addEventListener('change', function() {
            // Rapporter cette donnée au <p>
            selection = -1;
            selection  = select.selectedIndex;
            if(selection == 0){
                // Events
                rechInput.addEventListener('keyup', function(){
                    autocomplete(this.value);
                    resultDiv.innerHTML = "";
                    // console.log(this.value);
                });

            
             }

        })


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