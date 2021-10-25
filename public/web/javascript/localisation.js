function initialize() {
    let mapProp = {
        center:new google.maps.LatLng(48.684457, 6.163311),
        zoom:4,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

    let myLatLng = {lat: 48.684457, lng: 6.163311};
    let marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
    });

    let myLatLng2 = {lat: 50.684457, lng: 7.163311};
    let marker2 = new google.maps.Marker({
        position: myLatLng2,
        map: map,
    });

}

google.maps.event.addDomListener(window, 'load', initialize);