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
            }
        }
        xmlhttp.open('GET', 'public/web/script/sendAjout.php?idUtilisateur=' + msg.split("-")[1], false);
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