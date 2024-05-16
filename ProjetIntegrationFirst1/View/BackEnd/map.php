<!DOCTYPE html>
<html>
<head>
    <title>Mini-carte de localisation</title>
    <!-- Inclure la bibliothèque Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5GF7-lMCCPrMtNWpc1x6LJQvyxh6IPOk&callback=initMap" async defer></script>
    <style>
        /* Définir une taille pour la carte */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <script>
        // Fonction d'initialisation de la carte
        function initMap() {
            // Création d'une nouvelle carte Google Maps
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15, // Zoom par défaut
                mapTypeControl: true,
                streetViewControl: true,
                fullscreenControl: true
            });

            // Essayer d'obtenir la position actuelle de l'utilisateur
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userCoords = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(userCoords);
                }, function() {
                    // Gérer les erreurs de géolocalisation
                    handleLocationError(true, map.getCenter());
                });
            } else {
                // Le navigateur ne prend pas en charge la géolocalisation
                handleLocationError(false, map.getCenter());
            }

            // Création d'un marqueur pour marquer l'ESPRIT Tunisia sur la carte
            var espirtMarker = new google.maps.Marker({
                position: { lat: 36.899345262092005, lng: 10.189394119430952 },
                map: map,
                title: 'ESPRIT Tunisia',
                icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png' // Utilisation d'un marqueur personnalisé
            });

            // Ajouter une info-bulle à l'ESPRIT Tunisia
            var infowindow = new google.maps.InfoWindow({
                content: '<strong>ESPRIT Tunisia</strong><br>ESPRIT Tunisia'
            });
            espirtMarker.addListener('click', function() {
                infowindow.open(map, espirtMarker);
            });
        }

        // Fonction pour gérer les erreurs de géolocalisation
        function handleLocationError(browserHasGeolocation, coords) {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: coords,
                zoom: 15
            });
            var infoWindow = new google.maps.InfoWindow({
                content: browserHasGeolocation ?
                    "Erreur: Le service de géolocalisation a échoué." :
                    "Erreur: Votre navigateur ne prend pas en charge la géolocalisation."
            });
            var userMarker = new google.maps.Marker({ position: coords, map: map });
            infoWindow.open(map);
        }
    </script>
</head>
<body>
    <!-- Div pour afficher la carte -->
    <div id="map"></div>
</body>
</html>
