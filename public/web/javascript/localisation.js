google.maps.event.addDomListener(window, 'load', initialize);

listeContaminee = []
function getListeLocal(){
    //let rayon = document.querySelector("#rayon").value
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            let listeLocal = this.responseText.split("{\"error\":\"Not found.\"}")[1]
            JSON.parse(listeLocal).forEach(local => {
                //console.log(local)
                listeContaminee.push(local)
            })
        }
    }
    xmlhttp.open('GET', 'public/web/script/localisation.php', false);
    xmlhttp.send();
}

function initialize() {
    let mapProp = {
        center: new google.maps.LatLng(48.679628, 6.158803),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    getListeLocal()
    listeContaminee.forEach(local => {
        position(parseFloat(local.longitude), parseFloat(local.latitude))
    })
}

function position(lat, lng){
    let myLatLng = {lat: lat, lng: lng};
    let marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
    });
}
