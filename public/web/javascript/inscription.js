
window.onload=function() {
    var icon = document.getElementById("icon-user");
    var pass = document.getElementById("MotDePasse")
    var affichage = true;
    icon.onclick = function () {
        if (affichage === true) {
            pass.type = "text"
        } else {
            pass.type = 'password'
        }
        affichage = !affichage
    }

    var icon2=document.getElementById("icon-user2");
    var pass2=document.getElementById("MotDePasse2")
    var affichage2 = true;
    icon2.onclick=function(){
        if (affichage2 === true){
            pass2.type="text"
        }else{
            pass2.type='password'
        }
        affichage2 = !affichage2
    }
}