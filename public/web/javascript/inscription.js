
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