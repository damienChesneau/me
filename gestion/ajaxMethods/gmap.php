<?php include '../testPerPages.php'; ?>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap-button.css"></link>
<div id="maposition"></div>
<div id="map" style="width: 640px;height: 480px"></div>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script><button style="width: 640px;" class="btn btn-primary" onclick="remplirFormulaire();" >Remplir le formulaire avec ces informations</button>
<script>
    var centerpos = new google.maps.LatLng(48.8595199, 2.3444653);
    var addr = "";
    var longitude;
    var latitude;
    function remplirFormulaire() {
        window.parent.document.getElementById('nom').value = addr;
        window.parent.document.getElementById('longitude').value = longitude;
        window.parent.document.getElementById('latitude').value = latitude;
        window.parent.document.getElementById('active').checked = true;
        window.parent.closeModal();
        window.parent.document.getElementById('inner').innerHTML = "";
    }
    var optionsGmaps = {
        center: centerpos,
        navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 15
    };
    var map = new google.maps.Map(document.getElementById("map"), optionsGmaps);
    if (navigator.geolocation) {
        function affichePosition(position) {
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable: true,
                title: "Vous êtes ici"
            });
            geocodePosition(marker.getPosition());
            latitude = marker.getPosition().lat();
            longitude = marker.getPosition().lng();
            google.maps.event.addListener(marker, 'dragend', function() {
                geocodePosition(marker.getPosition());
                latitude = marker.getPosition().lat();
                longitude = marker.getPosition().lng();
            });
            map.panTo(latlng);
        }
        function erreurPosition(error) {
            var info = "Erreur lors de la géolocalisation : ";
            switch (error.code) {
                case error.TIMEOUT:
                    info += "Timeout !";
                    break;
                case error.PERMISSION_DENIED:
                    info += "Vous n’avez pas donné la permission";
                    break;
                case error.POSITION_UNAVAILABLE:
                    info += "La position n’a pu être déterminée";
                    break;
                case error.UNKNOWN_ERROR:
                    info += "Erreur inconnue";
                    break;
            }
            document.getElementById("maposition").innerHTML = info;
        }
        navigator.geolocation.getCurrentPosition(affichePosition, erreurPosition);
    } else {
        alert("Ce navigateur ne supporte pas la géolocalisation");
    }
    function printText(text) {
        document.getElementById("ajouter").innerHTML = text;
    }
    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                addr = (responses[0].formatted_address);

            } else {
                updateMarkerAddress('Cannot determine address at this location.');
            }
        });
    }
    var geocoder = new google.maps.Geocoder();
</script>