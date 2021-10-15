function show(){
    document.querySelector('#lightbox').style.display="block"
    document.querySelector('#lightbox').style.position = "absolute"
    visible=true
}

function hide(){
    document.querySelector('#lightbox').style.display="none"
    visible=false
}

let visible = false;
function getGroup(){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            document.querySelector('.menu').innerHTML = this.responseText.split("}")[1];
            document.querySelector("#nouGroup").addEventListener('click', () => {
                if(visible){
                    hide()
                }else {
                    show()
                }
            })
            document.querySelector(".close").addEventListener('click', hide)
            getContact()
        }
    }
    xmlhttp.open('GET', 'public/web/script/messagerie.php', false);
    xmlhttp.send();
}

getGroup()

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

function filtrer(){
    let value = document.querySelector("#key").value
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById('showmsg').style.display = "block";
            document.getElementById('showmsg').style.textAlign = 'center';
            document.getElementById('showmsg').innerHTML = this.responseText.split("}")[1];
            document.querySelectorAll("#chercher-user").forEach(user => {
                user.onclick = () => {
                    document.querySelector("#key").value = user.dataset.nom + "-" + user.dataset.id
                }
            })
        }
    }
    xmlhttp.open('GET', 'public/web/script/integAmi.php?NomUtilisateur=' + value, false);
    xmlhttp.send();
}
document.querySelector("#key").addEventListener('keyup', filtrer)


function insertContact(){
    let value = document.querySelector("#key").value
    let nomGroup = document.querySelector("#key-idGroup").value
    let id = value.split("-")[1]
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            alert('Intégration réussie!')
            setContactor(JSON.parse(this.responseText.split("{\"error\":\"Not found.\"}")[1]))
            document.querySelector("#numbers").innerHTML = JSON.parse(this.responseText.split("{\"error\":\"Not found.\"}")[1]).length
            getContact()
        }
    }
    xmlhttp.open('GET', 'public/web/script/insertContact.php?idUtilisateur=' + id + "&nomGroup=" + nomGroup, false);
    xmlhttp.send();
}
document.querySelector("#btn-integAmi").addEventListener("click", insertContact)

idGroup = -1
function getContact(){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
            document.querySelector("#numbers").innerHTML = JSON.parse(contactInfo).length
            setContactor(JSON.parse(contactInfo))
            messageList(JSON.parse(contactInfo))
           //document.querySelector(".send").addEventListener('click', sendMessage)
        }
    }
    document.querySelectorAll(".exbtn").forEach(div => {
        div.onclick = () => {
            document.querySelector(".nameGroup").innerHTML = div.dataset.nomgroup
            idGroup = div.dataset.idgroup
            xmlhttp.open('GET', 'public/web/script/contact.php?idGroup=' + div.dataset.idgroup, false);
            xmlhttp.send();
        }
    })
}
getContact()


function setContactor(user) {
    let html = '';
    for (let i = 0; i < user.length; i++) {
        html += `
<li class="person" data-chat="person1">
    <img src="` + user[i].headerimg + `" alt=""/>
    <span class="name">` + user[i].nomContact + `</span>
    <span class="time">` + user[i].tempsEnvoi + `</span>
</li>`;
    }
    document.querySelector('ul.people').innerHTML = html;
}


function messageList(data) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.querySelector('div.active-chat').innerHTML = ""
            for (let i = 0; i < data.length; i++) {
                //Si content est null, alors on n'affiche pas
                if (data[i].content !== ""){
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
                console.log(this.responseText.split("}"))
                let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
                setContactor(JSON.parse(contactInfo))
                messageList(JSON.parse(contactInfo))
                getContact()
            }
        }
        document.querySelectorAll(".exbtn").forEach(div => {
            div.onclick = () => {
                idGroup = div.dataset.idgroup
            }
        })
        xmlhttp.open('GET', 'public/web/script/sendMessage.php?message=' + msg + "&idGroup=" + idGroup, false);
        xmlhttp.send();
    }
}

document.querySelector(".send").addEventListener('click', sendMessage)



function creerGroup(){
    let nomGroup = document.querySelector("#nom-group").value
    if (nomGroup.length === 0){
    }else{
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4) {
                getGroup()
                alert('Création réussie!')
            }
        }
        xmlhttp.open('GET', 'public/web/script/group.php?nomGroup=' + nomGroup, false);
        xmlhttp.send();
    }
}
document.querySelector("#btn-group").addEventListener('click', creerGroup)


function show3(){
    document.querySelector('#board').style.display="block"
    document.querySelector('#board').style.position = "absolute"
    visible3=true
}

function hide3(){
    document.querySelector('#board').style.display="none"
    visible3=false
}

let visible3 = false;
function getBoard(){
    document.querySelector("#btn-board").addEventListener('click', () => {
        if(visible3){
            hide3()
        }else {
            show3()
        }
    })
    document.querySelector(".close3").addEventListener('click', hide3)
}
getBoard()





//Board uploader fichier

function clickUpLoad(str) {
    document.getElementById(str).click();
}

// affichage des infos de fichier uploadé
function fileChange(className) {
    document.querySelector(".d-already-upload").style.display="block"
    document.querySelector(".d-upload").style.display="none"
    let fileObj = document.getElementById(className).files[0]; // js 获取文件对象
    let index = fileObj.name.lastIndexOf(".");
    let fileType = fileObj.name.substr(index + 1);
    document.querySelector(".img-png").style.display="none"
    document.querySelector(".img-pdf").style.display="none"
    document.querySelector(".img-word").style.display="none"
    document.querySelector(".img-excel").style.display="none"
    if (fileType === 'png' || fileType === 'PNG' || fileType === 'jpg' || fileType === 'JPG') {
        document.querySelector(".img-png").style.display="inline-block"
    }
    if (fileType === 'pdf' || fileType === 'PDF') {
        document.querySelector(".img-pdf").style.display="inline-block"
    }
    if (fileType === 'doc' || fileType === 'DOC' || fileType === 'docx' || fileType === 'DOCX') {
        document.querySelector(".img-word").style.display="inline-block"
    }
    if (fileType === 'xlsx' || fileType === 'XLSX') {
        document.querySelector(".img-excel").style.display="inline-block"
    }
    document.querySelector(".s-file-name").textContent = fileObj.name
    document.querySelector(".s-file-name").attributes = fileObj.name

    let fileSize = '';
    if (fileObj.size > 1024 * 1024) {
        fileSize = (fileObj.size / 1024 / 1024).toFixed(2) + 'M';
    } else if (fileObj.size > 1024) {
        fileSize = (fileObj.size / 1024).toFixed(2) + 'KB';
    }
    document.querySelector(".s-file-size").textContent = fileSize

}

// uploader
function uploadFile(className) {
    fileChange(className)
    let fd = new FormData();
    fd.append("file", document.getElementById(className).files[0]);
    let xhr = new XMLHttpRequest();
    xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
            let percentComplete = Math.round(evt.loaded * 100 / evt.total);
            document.querySelector("#progress").innerHTML = "上传中" + percentComplete + "%";
        } else {
            document.querySelector("#progress").innerHTML = "无法计算";
        }
    }, false);
    let url = '';
    xhr.open("POST", url);
    xhr.send(fd);
}

// Ouvrir la fenêtre de supression
function openModal() {
    document.querySelector(".d-modal").style.display="block"
}

// fermer la fenêtre de supression
function closeModal() {
    document.querySelector(".d-modal").style.display="none"
}

// suppression du fichier
function deleteFile() {
    document.querySelector(".img-png").style.display="none"
    document.querySelector(".img-pdf").style.display="none"
    document.querySelector(".img-word").style.display="none"
    document.querySelector(".img-excel").style.display="none"
    document.querySelector(".s-file-name").textContent=""
    document.querySelector(".s-file-size").textContent=""
    document.querySelector(".d-already-upload").style.display="none"
    document.querySelector(".d-upload").style.display="block"
    document.querySelector(".d-modal").style.display="none"
}