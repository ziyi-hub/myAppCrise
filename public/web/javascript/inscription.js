document.querySelector('#NomUtilisateur').addEventListener('keyup', verifUserExistant);
window.onload=function() {
    let icon = document.getElementById("icon-user");
    let pass = document.getElementById("MotDePasse")
    let affichage = true;
    icon.onclick = function () {
        if (affichage === true) {
            pass.type = "text"
        } else {
            pass.type = 'password'
        }
        affichage = !affichage
    }

    let icon2=document.getElementById("icon-user2");
    let pass2=document.getElementById("MotDePasse2")
    let affichage2 = true;
    icon2.onclick=function(){
        if (affichage2 === true){
            pass2.type="text"
        }else{
            pass2.type='password'
        }
        affichage2 = !affichage2
    }
}

function verifUserExistant(){
    let str = document.getElementById("NomUtilisateur").value;
    if (str.length === 0){
        document.getElementById("showmsg2").innerHTML = "Veuillez renseigner tous les champs".fontcolor('red');
    }else {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200){
                document.getElementById('showmsg2').style.display = "block";
                document.getElementById('showmsg2').style.textAlign = 'center';
                document.getElementById('showmsg2').innerHTML = this.responseText.split("}")[1];
            }
        }
        xmlhttp.open('GET',"public/web/script/inscription.php?NomUtilisateur=" + str, true);
        xmlhttp.send();
    }
}