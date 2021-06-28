let index = 0;

function carousel(json){
    
    for(let a in json){
        index++;
        let boxCar = document.createElement('div');
        boxCar.setAttribute('class', 'carouselBox fade');
        let number = document.createElement('div');
        number.setAttribute('class', 'numbertext');
        let linkVid = document.createElement('a');
        linkVid.setAttribute('href', json[a].link);
        let imgBox = document.createElement('img');
        imgBox.setAttribute('src', json[a].pic);
        
        let dot = document.createElement('span');
        dot.setAttribute('class', 'dot');
        
        
        boxCar.appendChild(number);
        linkVid.appendChild(imgBox);
        boxCar.appendChild(linkVid);
        sezCaro.appendChild(boxCar);
        divDots.appendChild(dot);
    } 
}

let slideIndex = 0;

function showSlides(){
    let slides = document.querySelectorAll('.carouselBox');
    let dots = document.querySelectorAll('.dot')
    
    for (let i = 0; i<slides.length; i++){
        slides[i].style.display = 'none';
    }
    slideIndex++;
    if(slideIndex > slides.length){
        slideIndex = 1;
    }

    for(i = 0; i<dots.length; i++){
        dots[i].className = dots[i].className.replace(" active", "");
    }
    let less = slideIndex -1;
    slides[less].style.display = "flex";  
    dots[less].className += " active";
    setTimeout(showSlides, 4500);
}

function onclick(event){
    let paragr = event.currentTarget.parentNode.querySelector('p');
    let text = event.currentTarget.parentNode.querySelector('.dettagli span');
    let img = event.currentTarget.parentNode.querySelector('.dettagli img');
    if(paragr.style.display === 'none'){
        paragr.style.display = "";

    }else{
        paragr.style.display = "none";
    }
    
}

function onJsonCont(json){
    carousel(json);
    showSlides();
}

function onJson(json){
    console.log('JSON ricevuto');
    // Svuotiamo la libreria
    const library = document.querySelector('#sezVideo');
    library.innerHTML = '';
    
    creaBoxVid(json.items);

}

function onError(error){
    console.log('Error: ' + error);
}

function onResponse(response){

    return response.json();
}




function caricaVideo(){
    fetch(route('carousel')).then(onResponse, onError).then(onJsonCont);
}



const RIGHT_ARROW = 'Immagini/syt.png';
const DOWN_ARROW = 'Immagini/up1.png';

const sezCaro = document.querySelector('#carouselVid');
const divDots = document.querySelector('#divDot');
const sezVid = document.querySelector('#sezVideo');
const form = document.querySelector('form');
caricaVideo();