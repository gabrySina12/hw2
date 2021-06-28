function notizie(json){

    for(let c in json){
        let pref = document.createElement('a');
        pref.setAttribute('class', 'star1');
        
        for(let a in prefe){ 
            if(prefe[a].link === json[c].link){
               
                pref.setAttribute('class', 'star2');;
            }
        }
        let box = document.createElement('div');
        box.setAttribute('class', 'sez');
        let topside = document.createElement('div');
        topside.setAttribute('id', 'topside');
        let titolo = document.createElement('h1');
        let txtT = document.createTextNode(json[c].nome);        
        let cittaP = document.createElement('p');
        let citta= document.createTextNode(json[c].citta);
        cittaP.style.display = 'none';
        let link =document.createElement('a');
        link.setAttribute('href', json[c].link);
        let img = document.createElement('img');
        img.setAttribute('src', json[c].pic);
        img.setAttribute('class', 'linkNews');
        let divDe = document.createElement('div');
        divDe.setAttribute('class', 'divDe');
        let descr = document.createElement('span');
        let descrTxt = document.createTextNode(json[c].descrizione);
        let meteo = document.createElement('div');
        meteo.setAttribute('class', 'meteo');
        meteo.style.display = 'none';

        let dettagli =document.createElement('a');
        dettagli.setAttribute('class', 'botton')
        let iconMe = document.createElement('img');
        iconMe.setAttribute('src', 'Immagini/weather.png')
        let dettagliSez = document.createElement('span');
        dettagliSez.setAttribute('class', 'mostraMeteo');
        let dettagliTxt = document.createTextNode('Mostra meteo');
        titolo.appendChild(txtT);
        topside.appendChild(titolo);
        topside.appendChild(pref);
        box.appendChild(topside);
        cittaP.appendChild(citta);
        box.appendChild(cittaP)
        link.appendChild(img);
        box.appendChild(link);
        descr.appendChild(descrTxt);
        divDe.appendChild(descr);
        box.appendChild(divDe);
        box.appendChild(meteo);

        dettagliSez.appendChild(dettagliTxt);
        dettagli.appendChild(iconMe);
        dettagli.appendChild(dettagliSez);
        dettagli.addEventListener('click', mostraMeteo);
        box.appendChild(dettagli);
        pref.addEventListener('click', aggPref);

        
        weather1.appendChild(box);
    }

}

function hideErr(){
    let err = document.querySelector('.news_err');
    err.textContent = '';
}

function jsonAgg(json){
    let but = document.querySelector('.star1');
    let err = document.querySelector('.news_err');
    if(json.exist == true){
        but.classList.add('star2'); 
        but.classList.remove('star1');
    }else{
        err.textContent = 'Devi effettuare il login per poter aggiungere ai preferiti';
        setTimeout(hideErr, 3000);
    }
}

function aggPref(event){
    let title = event.currentTarget.parentNode.querySelector('#topside h1').textContent;
    
    let but = event.currentTarget.parentNode.querySelector('.star1');
    let but2 = event.currentTarget.parentNode.querySelector('.star2');
    
    
    if(but){
        
        fetch(route('aggPref', title)).then(onResponse, onError).then(jsonAgg);
        
               
    }else{
        fetch(route('remove', title));
        but2.classList.add('star1');
        but2.classList.remove('star2');
        
    }
}

function mostraMeteo(event){
  
    let citta1 = event.currentTarget.parentNode.querySelector('p').textContent;
    let divMeteo = event.currentTarget.parentNode.querySelector('.meteo');
    let txt = event.currentTarget.parentNode.querySelector('.mostraMeteo');
    if(divMeteo.style.display === 'none'){
        fetch(route('api_weather', citta1)
        ).then(onResponse, onError).then(json=>{
            console.log(json);
            let icon = document.createElement('img');
            icon.setAttribute('src', json['0'].weather_icons);
            console.log(json['0'].cloudcover);
            let nuvolosita = document.createElement('p');
            let nuvTxt = document.createTextNode('Nuvolosità: ' + json['0'].cloudcover + '%');
            let umidita = document.createElement('p');
            let umTxt = document.createTextNode('Umidità: ' + json['0'].humidity + '%');
            let Precipitazioni = document.createElement('p');
            let preciTxt = document.createTextNode('Precipitazioni: ' + json['0'].precip + '%');

            divMeteo.appendChild(icon);
            nuvolosita.appendChild(nuvTxt);
            divMeteo.appendChild(nuvolosita);
            umidita.appendChild(umTxt);
            divMeteo.appendChild(umidita);
            Precipitazioni.appendChild(preciTxt);
            divMeteo.appendChild(Precipitazioni);

        });
        divMeteo.style.display = '';
        txt.textContent = 'Nascondi Meteo';
    }else{
        divMeteo.style.display = 'none';
        txt.textContent = 'Mostra Meteo';
    }
    
}

function jsonPref(json){
    prefe = json;

}


function onError(error){
    console.log('Error: ' + error.toString());
}

function onResponse(response) {
    return response.json();
  }

  function jsonNews(json){
      notizie(json);

  }

function preferiti(){
    fetch(route('preferiti')).then(onResponse, onError).then(jsonPref).catch(onError);
}

function list(){
      let gif = document.getElementById('loading');
      gif.style.display = 'none';
      fetch(route('eventi')).then(onResponse, onError).then(jsonNews);
    
}

function jsonSerch(json){
    let cat = document.querySelectorAll('.sez');
    for(let c of cat){
        
            c.style.display = 'none';
        
    }
    for(let a of json){
        
        for(let d of cat){
        let tit = d.innerText;
        if(tit.indexOf(a.nome)>-1){
            d.style.display = '';
            }
        }
    }
}

function ricerca(event){

    
    let filtro = event.currentTarget.value;

    fetch(route('search', filtro)).then(onResponse, onError).then(jsonSerch).catch(onError);

}

const weather1 = document.querySelector('.weather');
const input = document.getElementById('search').addEventListener('blur', ricerca);
let prefe;
preferiti();
setTimeout(list, 2000);