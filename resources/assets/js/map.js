function initMap() {
    'use strict';
    var myLatLng = {lat: 30.363, lng: -90.044},
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: myLatLng
        }),

        contacts = document.getElementsByClassName('contact-info');

    for (let i = contacts.length - 1; i >= 0; i--)
    {
        let lat = contacts[i].dataset.lat;
        let lng = contacts[i].dataset.lng;
        let name = contacts[i].innerHTML;
        let agent = contacts[i].dataset.agent;
        let marker = new google.maps.Marker({
            position: {'lat': parseInt(lat), 'lng': parseInt(lng)},
            map: map,
            title: name
        });
        let infowindow = new google.maps.InfoWindow({
            content: 'Name: ' + name + '. Agent: ' + agent
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }

    var agents = document.getElementsByClassName('agent-info');

    for (let i = agents.length - 1; i >= 0; i--)
    {
        let lat = agents[i].dataset.lat;
        let lng = agents[i].dataset.lng;
        let name = agents[i].innerHTML;
        let marker = new google.maps.Marker({
            position: {'lat': parseInt(lat), 'lng': parseInt(lng)},
            map: map,
            label: 'A'
        });
        let infowindow = new google.maps.InfoWindow({
            content: 'Agent: ' + name
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });

    }
}

initMap();