function show(){
    document.querySelector('#lightbox').style.display="block"
    document.querySelector('#lightbox').style.position = "absolute"
    visible=true
}


function hide(){
    document.querySelector('#lightbox').style.display="none"
    visible=false
}
var visible = false;
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
        }
    }
    xmlhttp.open('GET', 'public/web/script/messagerie.php', false);
    xmlhttp.send();
}

getGroup()


function getContact(){
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            let contactInfo = this.responseText.split("{\"error\":\"Not found.\"}")[1]
            document.querySelector("#numbers").innerHTML = JSON.parse(contactInfo).length
            setContactor(JSON.parse(contactInfo))
            messageList(JSON.parse(contactInfo))
            JSON.parse(contactInfo).forEach(contact => {
                console.log(contact)
            })
        }
    }
    document.querySelectorAll(".exbtn").forEach(div => {
        div.onclick = () => {
            document.querySelector(".name").innerHTML = div.dataset.nomgroup
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
            console.log()
            document.querySelector('div.active-chat').innerHTML = ""
            for (let i = 0; i < data.length; i++) {
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
                    console.log(data[i].tempsEnvoi)
                    let active_chat = document.querySelector('div.active-chat');
                    let oldHtml = active_chat.innerHTML;
                    active_chat.innerHTML = oldHtml + html;
                    active_chat.scrollTop = active_chat.scrollHeight;
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
            }
        }
        xmlhttp.open('GET', 'public/web/script/sendMessage.php?message=' + msg, false);
        xmlhttp.send();
    }
}

document.querySelector(".send").addEventListener('click', sendMessage)
sendMessage()
