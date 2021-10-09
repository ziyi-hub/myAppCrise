oeil();
load();

function oeil(){
    let icon4 = document.getElementById("icon-user4");
    let pass4 = document.getElementById("amdp")
    let icon5 = document.getElementById("icon-user5");
    let pass5 = document.getElementById("mdp")
    let affichage4 = true;
    let affichage5 = true;

    icon4.onclick = function () {
        if (affichage4 === true) {
            pass4.type = "text"
        } else {
            pass4.type = 'password'
        }
        affichage4 = !affichage4
    }

    icon5.onclick = function () {
        if (affichage5 === true) {
            pass5.type = "text"
        } else {
            pass5.type = 'password'
        }
        affichage5 = !affichage5
    }
}

function uploadPhoto() {
    document.querySelector("#prompt3").style.display = "none";
    let reads = new FileReader();
    let f = document.getElementById('file').files[0];
    reads.readAsDataURL(f);
    reads.onload = function() {
        document.getElementById('img3').src = this.result;
        document.querySelector("#img3").style.display = "block";
        localStorage.removeItem('image');
        localStorage.setItem('image', this.result);
    };
}

function load() {
    let tmp = localStorage.getItem('image');
    if (tmp){
        document.getElementById('img3').src = tmp;
        document.querySelector("#prompt3").remove();
        document.querySelector("#img3").style.display = "block";

    }
}
