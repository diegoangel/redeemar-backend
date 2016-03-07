(function init() {


    $('#submitForm').click(function(){
        $('form[name="location"]').submit();
    });


    /*** Google Maps ***/

    var input = document.getElementById('location_address');
    /** if the user is coming to edit then transform address to coordinates**/
    if(input.value){
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': input.value}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                console.log(results)
                setAll(input,results,1);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }else{
        setAll(input,[],0);
    }


    /***** Its alive! ******/
    function setAll(input,results,oldLocation){
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            center: results.length != 0 ? results[0].geometry.location : {lat: 38.894036, lng: -77.036420},
            zoom: 13
        });

        var autocomplete = new google.maps.places.Autocomplete(input,{
            componentRestrictions: {country: "us"}
        });
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        if(oldLocation){
            if (results[0].geometry.viewport) {
                map.fitBounds(results[0].geometry.viewport);
            } else {
                map.setCenter(results[0].geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setIcon(/** @type {google.maps.Icon} */({
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(results[0].geometry.location);
            marker.setVisible(true);

            var address = '';
            if (results[0].address_components) {
                address = [
                    (results[0].address_components[0] && results[0].address_components[0].short_name || ''),
                    (results[0].address_components[1] && results[0].address_components[1].short_name || ''),
                    (results[0].address_components[2] && results[0].address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + results[0].formatted_address + '</strong><br>' + address);
            infowindow.open(map, marker);
        }

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setIcon(/** @type {google.maps.Icon} */({
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
        });
    }

})();
