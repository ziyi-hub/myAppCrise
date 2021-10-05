
document.querySelector('.entete').addEventListener('keyup', getFiltrer);

function getFiltrer(){
    let str = document.getElementById("keywords").value;
    if (str.length === 0){
        document.getElementById('showmsg').innerHTML = "";
    }else {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                console.log(this.responseText.split("}")[1]);
                document.getElementById('showmsg').style.display = "block";
                document.getElementById('showmsg').style.textAlign = 'center';
                document.getElementById('showmsg').innerHTML = this.responseText.split("}")[1];
                document.querySelectorAll("#chercher-user").forEach(user => {
                    user.onclick = () => {
                        ajoutAmi(user)
                    }
                })
            }
        }
        xmlhttp.open('GET', 'public/web/script/filtrer.php?NomUtilisateur=' + str, true);
        xmlhttp.send();
    }
}

function ajoutAmi(info){
    document.querySelector(".messagerie-user").innerHTML += `
    <div id="listeAmi">
        <div class="c1" id="c1">
            <div id="prompt3">
                <span id="imgSpan" style="left: 0; right: 0 ">${info.dataset.nom}</span>
            </div>
            <img id="img3" alt="portrait"/>        
        </div>
    </div>
    `
}