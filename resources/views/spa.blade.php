<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BOBB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{mix('css/app.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://developer.api.autodesk.com/modelderivative/v2/viewers/7.*/style.min.css" type="text/css">
        <script src="https://developer.api.autodesk.com/modelderivative/v2/viewers/7.*/viewer3D.min.js"></script>
	</head>
    <body class="antialiased">
        <div id="app">
			<app></app>
		</div>
		<script charset="utf-8">
			window.auth_user = {!! json_encode($auth_user); !!};
		</script>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
