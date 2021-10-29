function filtrer(){
    let value = document.querySelector("#keywords").value
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById('showmsg').style.display = "block";
            document.getElementById('showmsg').style.textAlign = 'center';
            document.getElementById('showmsg').innerHTML = this.responseText.split("}")[1];
            document.querySelectorAll("#chercher-user").forEach(user => {
                user.onclick = () => {
                    document.querySelector("#keywords").value = user.dataset.nom + "-" + user.dataset.id
                }
            })
        }
    }
    xmlhttp.open('GET', 'public/web/script/filtrer.php?NomUtilisateur=' + value, false);
    xmlhttp.send();
}
document.querySelector("#keywords").addEventListener('keyup', filtrer)


function sendAjout() {
    let msg = document.querySelector("#keywords").value;
    if (msg.length === 0){
    }else{
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                alert('Ajout réussie!')
                let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
                //console.log(JSON.parse(contactInfo))
                setContactor(JSON.parse(contactInfo))
            }
        }
        xmlhttp.open('GET', 'public/web/script/ajoutAmi.php?idUtilisateur=' + msg.split("-")[1], false);
        xmlhttp.send();
    }
}

document.querySelector("#btn-integAmi").addEventListener('click', sendAjout)


let visible2 = false;
function showFiltrer(){
    document.querySelector('#recheAmi').style.display="block"
    document.querySelector('#recheAmi').style.position = "absolute"
    visible2=true
}


function hideFiltrer(){
    document.querySelector('#recheAmi').style.display="none"
    visible2=false
}

function open(){
    document.querySelector("#nouGroup2").addEventListener('click', ()=>{
        if(visible2){
            hideFiltrer()
        }else {
            showFiltrer()
        }
        document.querySelector(".close2").addEventListener('click', hideFiltrer)
    })
}
open()


function setContactor(user) {
    let html = '';
    for (let i = 0; i < user.length; i++) {
        html += `
<li class="person" data-chat=${user[i].idUtilisateur}>
    <img src="` + user[i].headerimg + `" alt=""/>
    <span class="name">` + user[i].nomContact + `</span>
    <span class="time"></span>
</li>`;
    }
    document.querySelector('ul.people').innerHTML = html;
    getMessage()
}

function getListAmi(){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
            setContactor(JSON.parse(contactInfo))
        }
    }
    xmlhttp.open('GET', 'public/web/script/getListAmi.php', false);
    xmlhttp.send();
}
getListAmi()

idUser = -1
function getMessage(){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
            //console.log(contactInfo)
            messageList(JSON.parse(contactInfo))
        }
    }
    document.querySelectorAll(".person").forEach(user => {
        user.onclick = () => {
            idUser = user.dataset.chat
            xmlhttp.open('GET', 'public/web/script/getMessageIndividu.php?idUser=' + user.dataset.chat, false);
            xmlhttp.send();
        }
    })
}
getMessage()

function messageList(data) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.querySelector('div.active-chat').innerHTML = ""
            for (let i = 0; i < data.length; i++) {
                //Si content est null, alors on n'affiche pas
                if ((data[i].content !== "") && (data[i].content.indexOf("data:") === -1)){
                    if (data[i].nomContact === this.responseText) {
                        html = `
                    <span class="preview" style="text-align: center;">${data[i].tempsEnvoi}</span>
                    <div class="message" style="margin-bottom: 15px;">
                        <img class="me-header" src="` + data[i].headerimg + `" alt=""/>
                        <div class="bubble me">` + data[i].content + `</div>
                    </div>`;
                        let active_chat = document.querySelector('div.active-chat');
                        let oldHtml = active_chat.innerHTML;
                        active_chat.innerHTML = oldHtml + html;
                        active_chat.scrollTop = active_chat.scrollHeight;
                    } else {
                        html = `
                    <span class="preview" style="text-align: center;">${data[i].tempsEnvoi}</span>
                    <div class="message" style="margin-bottom: 15px;">
                        <img src="` + data[i].headerimg + `" alt=""/>
                        <div class="bubble you">` + data[i].content + `</div>
                    </div>`;
                        let active_chat = document.querySelector('div.active-chat');
                        let oldHtml = active_chat.innerHTML;
                        active_chat.innerHTML = oldHtml + html;
                        active_chat.scrollTop = active_chat.scrollHeight;
                    }
                }else if(data[i].content.indexOf("data:image") !== -1){
                    if (data[i].nomContact === this.responseText) {
                        html = `
                    <span class="preview" style="text-align: center;">${data[i].tempsEnvoi}</span>
                    <div class="message" style="margin-bottom: 15px;">
                        <img class="me-header" src="` + data[i].headerimg + `" alt=""/>
                        <div class="bubble me"><embed src='` + data[i].content + `' width=150 height=100></div>
                    </div>`;
                        let active_chat = document.querySelector('div.active-chat');
                        let oldHtml = active_chat.innerHTML;
                        active_chat.innerHTML = oldHtml + html;
                        active_chat.scrollTop = active_chat.scrollHeight;
                    } else {
                        html = `
                    <span class="preview" style="text-align: center;">${data[i].tempsEnvoi}</span>
                    <div class="message" style="margin-bottom: 15px;">
                        <img src="` + data[i].headerimg + `" alt=""/>
                        <div class="bubble you"><embed src='` + data[i].content + `' width=150 height=100></div>
                    </div>`;
                        let active_chat = document.querySelector('div.active-chat');
                        let oldHtml = active_chat.innerHTML;
                        active_chat.innerHTML = oldHtml + html;
                        active_chat.scrollTop = active_chat.scrollHeight;
                    }
                }else if (data[i].content.indexOf("data:audio") !== -1){
                    if (data[i].nomContact === this.responseText) {
                        html = `
                    <span class="preview" style="text-align: center;">${data[i].tempsEnvoi}</span>
                    <div class="message" style="margin-bottom: 15px;">
                        <img class="me-header" src="` + data[i].headerimg + `" alt=""/>
                        <div class="bubble me"><video controls src='` + data[i].content + `'></div>
                    </div>`;
                        let active_chat = document.querySelector('div.active-chat');
                        let oldHtml = active_chat.innerHTML;
                        active_chat.innerHTML = oldHtml + html;
                        active_chat.scrollTop = active_chat.scrollHeight;
                    } else {
                        html = `
                    <span class="preview" style="text-align: center;">${data[i].tempsEnvoi}</span>
                    <div class="message" style="margin-bottom: 15px;">
                        <img src="` + data[i].headerimg + `" alt=""/>
                        <div class="bubble you"><video controls src='` + data[i].content + `'></div>
                    </div>`;
                        let active_chat = document.querySelector('div.active-chat');
                        let oldHtml = active_chat.innerHTML;
                        active_chat.innerHTML = oldHtml + html;
                        active_chat.scrollTop = active_chat.scrollHeight;
                    }
                }
            }
        }
    }
    xmlhttp.open('GET', 'public/web/script/userMoi.php', false);
    xmlhttp.send();
}


function sendMessage() {
    let msg = document.querySelector("#input-value").value;
    if (msg.length === 0){
    }else{
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
                console.log(contactInfo)
                messageList(JSON.parse(contactInfo))
                getMessage()
            }
        }
        //console.log(idUser)
        xmlhttp.open('GET', 'public/web/script/sendMessageIndividu.php?message=' + msg + "&idUtilisateur=" + idUser, false);
        xmlhttp.send();
    }
}

document.querySelector(".send").addEventListener('click', sendMessage)


function upload() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
            messageList(JSON.parse(contactInfo))
            getMessage()
        }
    }

    let fd = new FormData();
    let reads = new FileReader();
    let f = document.getElementById('file').files[0];
    reads.readAsDataURL(f);
    reads.onload = function() {
        fd.append("blob", this.result);
        fd.append("id", idUser);
        xhr.open('POST', 'public/web/script/sendFichier.php', false);
        xhr.send(fd);
    };
}
upload()