function initialize() {
    let mapProp = {
        center:new google.maps.LatLng(48.684457, 6.163311),
        zoom:4,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

    position(48.684457, 6.163311)
    position(50.684457, 7.163311)

}

function position(lat, lng){
    let myLatLng = {lat: lat, lng: lng};
    let marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
    });
}

google.maps.event.addDomListener(window, 'load', initialize);