//Menù laterale
function change(event){
    let var1 = document.getElementById('option');
    let var2 = document.getElementById('gSquadra');
    let var5= document.getElementById('favorite');
    let var3 = event.currentTarget;
    let var4 = event.currentTarget.parentNode.querySelector('.active');
        var4.classList.remove('active')
        var2.style.display = 'none';
        var5.style.display = 'none'
        var3.classList.add('active');
        var1.style.display = 'flex';   
}

function change2(event){
    let var1 = document.getElementById('option');
    let var2 = document.getElementById('gSquadra');
    let var5= document.getElementById('favorite');
    let var3 = event.currentTarget;
    let var4 = event.currentTarget.parentNode.querySelector('.active');
        var4.classList.remove('active');
        var1.style.display = 'none';
        var5.style.display = 'none';
        var3.classList.add('active');
        var2.style.display = 'flex';
}

function change3(event){
    let var1 = document.getElementById('option');
    let var2 = document.getElementById('gSquadra');
    let var5= document.getElementById('favorite');
    let var3 = event.currentTarget;
    let var4 = event.currentTarget.parentNode.querySelector('.active');
    var4.classList.remove('active');
    var1.style.display = 'none';
    var2.style.display = 'none';
    var3.classList.add('active');
    var5.style.display = 'flex';
}

function jsonNewTeam(json){
    console.log(document.querySelector('.update'));
    if(json.exists === true){
        document.querySelector('.newT').classList.remove('errorj');
        document.querySelector('.squadra_err').textContent = "";
        document.querySelector('.update').textContent = input.value;
        showGif();
        
    }else{
        document.querySelector('.squadra_err').textContent = "Nome utente già utilizzato o già in una squadra";
        document.querySelector('.newT').classList.add('errorj'); 
    }
}

//check team per la creazione ed eventuale creazione
function jsonCheckTeam(json){
    
    if(!json.exists){
        check = false;
        fetch(route('newTeam', input.value)).then(fetchResponse, onError).then(jsonNewTeam);
        
    }       
}

function fetchResponse(response){
    if(!response.ok) return null;
    return response.json();
}

function checkTeam(event){
    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)){
        document.querySelector('.newT').classList.add('errorj');
        input.parentNode.parentNode.parentNode.querySelector('.squadra_err').textContent = "Sono ammesse lettere, numeri e underscore. Massimo 15 caratteri";
    }else
    {   
        input.parentNode.parentNode.parentNode.querySelector('.squadra_err').textContent = "";
        document.querySelector('.newT').classList.remove('errorj');
        fetch(route("checkTeam",input.value)).then(fetchResponse).then(jsonCheckTeam);
    }
    
}

function showGif(){
    document.querySelector('.gif').classList.remove('hidden');
    setTimeout(hideGif, 4500);
}

function hideGif(){
    document.querySelector('.gif').classList.add('hidden');
}

function onError(error){
    console.log('Error: ' + error);
}

function hideErr(){
    document.querySelector('.form').textContent = '';
}

function jsonJoin(json){
    if(json.exists === true){
        document.querySelector('.update').textContent = json.nome;
    }else{
        setTimeout(hideErr, 3000);
        document.querySelector('.form').textContent = 'Sei già in una squadra';
    }
}

function join(event){
    event.preventDefault();
    let input = event.currentTarget.parentNode.querySelector('select').value;
    fetch(route('join', input)).then(fetchResponse, onError).then(jsonJoin);    
}

function jsonTeam(json){
    const sez = document.querySelector('.select');
    json.shift()
    for(c of json){
    let row = document.createElement("option");
    row.setAttribute('value', c.nome.replaceAll('"', ''));
    let textNames = document.createTextNode(c.nome.replaceAll('"',''));
    row.appendChild(textNames);
    sez.appendChild(row);
    }
    
}

function teamList(){
    fetch(route('teamList')).then(fetchResponse, onError).then(jsonTeam);
    
}

function jsonFav(json){
    for(let c in json){

        let box = document.createElement('div');
        box.setAttribute('class', 'sez');
        let topside = document.createElement('div');
        topside.setAttribute('id', 'topsideMember');
        let titolo = document.createElement('h1');
        let txtT = document.createTextNode(json[c].titolo);
        let del = document.createElement('a');
        del.style.backgroundImage = "url('Immagini/delete.png')";      
        let link =document.createElement('a');
        link.setAttribute('href', json[c].link);
        link.setAttribute('class', 'prefPic');
        let img = document.createElement('img');
        img.setAttribute('src', json[c].pic);
        
        let divDe = document.createElement('div');
        divDe.setAttribute('class', 'divDe');
        let descr = document.createElement('span');
        let descrTxt = document.createTextNode(json[c].descrizione);


        titolo.appendChild(txtT);
        topside.appendChild(titolo);
        topside.appendChild(del);
        box.appendChild(topside);
        link.appendChild(img);
        box.appendChild(link);
        descr.appendChild(descrTxt);
        divDe.appendChild(descr);
        box.appendChild(divDe);
        del.addEventListener('click', deletePref);
        sez.appendChild(box);
    }
}

function favorite(){
    fetch(route('prefM')).then(fetchResponse, onError).then(jsonFav).catch(onError);
}

function deletePref(event){
    let title = event.currentTarget.parentNode.querySelector('h1').textContent;
    let father = event.currentTarget.parentNode.parentNode.parentNode;
    let child = event.currentTarget.parentNode.parentNode;
    father.removeChild(child);
    fetch(route('deleteM', title));
}

function jsonInfo(json){
    let myteams = document.getElementById('my_teams');
    let dSquadra = document.createElement('div');
    dSquadra.setAttribute('class', 'row__label update');
    let nom = json[0].nome.replaceAll('"', '');
    let squadra = document.createTextNode(nom);

    //posso farmi stampare le informazioni della squadra
    dSquadra.appendChild(squadra);
    myteams.appendChild(dSquadra);
    
}

function my_teams(){
    fetch(route('infoT')).then(fetchResponse, onError).then(jsonInfo).catch(onError);
}

function jsonConta(json){
    let set = document.querySelector('.proce');
    for(c of json){
        
         set.textContent = "Per l'evento "+ c.nome_evento + ' partecipano ' + c.squadre_partecipanti + ' squadre/a';

    }
}

function contaSquadre(event){
    event.preventDefault();
    let squadra = document.getElementById('conta');
    fetch(route('p4', squadra.value)).then(fetchResponse, onError).then(jsonConta).catch(onError);
}

function hideLeave(){
    document.querySelector('.leave1').textContent = '';
}

function jsonLeave(json){
    if(json.exists === true){
        document.querySelector('.update').textContent = 'Non in squadra';
        document.querySelector('.leave1').textContent = 'Squadra lasciata';
        setTimeout(hideLeave, 3000);
    }else if(json.exists === false){
        document.querySelector('.leave1').textContent = 'Impossibile lasciare la squadra';
        setTimeout(hideLeave, 3000);
    }
}

function leave(){
    fetch(route('leave')).then(fetchResponse, onError).then(jsonLeave);
}
const input = document.querySelector('.my_team');
const sez =  document.getElementById('fav_items')
let check = true;
const op =document.getElementById('option_but');
const gs = document.getElementById('gSquadra_but');
const fv = document.getElementById('favorite_but');
op.addEventListener('click', change);
gs.addEventListener('click', change2);
fv.addEventListener('click', change3);
document.querySelector('.leave').addEventListener('click', leave);
document.querySelector('.my_team').addEventListener('blur', checkTeam);
document.querySelector('.send').addEventListener('click', join);
document.getElementById('conta').addEventListener('blur', contaSquadre);
teamList();
my_teams();
favorite();