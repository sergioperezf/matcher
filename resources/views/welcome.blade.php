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
            #points, #clustered-points {
                display: none;
            }
        </style>
    </head>
    <body>
    <ul id="points">
        @foreach ($points as $point)
            <li data-x="{{ $point[0] }}" data-y="{{ $point[1] }}"></li>
        @endforeach
    </ul>
    <ul id="clustered-points">
        @foreach ($clusteredData as $cluster)
            <ul>
            @foreach ($cluster as $point)
                <li data-x="{{ $point[0] }}" data-y="{{ $point[1] }}"></li>
            @endforeach
            </ul>
        @endforeach
    </ul>
    <canvas id="canvas">
    </canvas>
    <script>
        var clusters = document.getElementById('clustered-points').getElementsByTagName('ul');
        var canvas = document.getElementById("canvas");
        canvas.setAttribute("width", window.innerWidth);
        canvas.setAttribute("height", window.innerHeight);
        var ctx = canvas.getContext("2d");
        var colours = ['green', 'blue', 'red', 'yellow', 'gray'];
        for (let i = 0; i < clusters.length; i++) {
            let points = clusters[i].getElementsByTagName('li');
            ctx.fillStyle = colours[i];
            for (let i = 0; i < points.length; i++) {
                ctx.fillRect(points[i].dataset.x, points[i].dataset.y, 5, 5);
            }
        }

    </script>
    </body>
</html>
