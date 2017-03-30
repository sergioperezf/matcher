<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <title>{{ env('APP_ENV') != 'prod' ? '[' . strtoupper(env('APP_ENV')) . ']':'' }} Matcher - @yield('title')</title>

    <link href="css/app.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="content container">
    @yield('content')
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}">
</script>
<script src="js/app.js"></script>

</body>
</html>
