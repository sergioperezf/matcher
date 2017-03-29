<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        #map {
            width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Agent Id</th>
        <th>Contact Name</th>
        <th>Contact Zip Code</th>
    </tr>
    <tbody>
    @foreach ($clusteredData as $cluster)
        <tr>
            <th class="agent-info" data-lat="{{ $cluster->getAgent()->getCoordinates()[0] }}" data-lng="{{ $cluster->getAgent()->getCoordinates()[1] }}" colspan="3">{{ $cluster->getAgent()->getName() }}</th>
        </tr>
        @foreach ($cluster as $key => $point)
            <tr>
                <td>{{ $cluster->getAgent()->getName() }}</td>
                <td class="contact-info" data-agent="{{ $cluster->getAgent()->getName() }}" data-lat="{{ $cluster->getSpace()[$point]->getCoordinates()[0] }}"  data-lng="{{ $cluster->getSpace()[$point]->getCoordinates()[1] }}" >{{ $cluster->getSpace()[$point]->getName() }}</td>
                <td>{{ $cluster->getSpace()[$point]->getZip() }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
<div id="map"></div>
<script>
    function initMap() {
        var myLatLng = {lat: 30.363, lng: -90.044};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: myLatLng
        });

        var contacts = document.getElementsByClassName('contact-info');

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
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}&callback=initMap">
</script>

</body>
</html>
