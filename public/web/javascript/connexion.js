
window.onload=function() {
    let icon3 = document.getElementById("icon-user3");
    let pass3 = document.getElementById("password")
    let affichage3 = true;
    icon3.onclick = function () {
        if (affichage3 === true) {
            pass3.type = "text"
        } else {
            pass3.type = 'password'
        }
        affichage3 = !affichage3
    }
}