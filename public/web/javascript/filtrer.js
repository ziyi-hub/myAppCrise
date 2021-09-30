
document.querySelector('.entete').addEventListener('keyup', getFiltrer);

function getFiltrer(){
    var str = document.getElementById("keywords").value;
    if (str.length === 0){
        document.getElementById('showmsg').innerHTML = "";
    }else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                console.log(this.responseText);
                document.getElementById('showmsg').style.display = "block";
                document.getElementById('showmsg').style.textAlign = 'center';
                document.getElementById('showmsg').innerHTML = this.responseText;
            }
        }
        xmlhttp.open('GET', 'public/web/script/filtrer.php?NomUtilisateur=' + str, false);
        xmlhttp.send(str);
    }
}