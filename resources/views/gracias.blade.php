<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Code Challenge</title>
    @vite('resources/css/app.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;400&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
</head>

<body class="bg-grey-5">
    <div class="flex justify-center items-center m-auto h-screen ">
        <div class="w-1/2 overflow-hidden rounded-lg bg-grey-5 shadow-md duration-300 hover:scale-105 hover:shadow-xl px-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mt-8 h-16 w-16 text-turquoise-100" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <h1 class="mt-2 text-center text-2xl font-bold text-blue-100 font-mulish">Solicitud enviada</h1>
            <p class="my-4 text-center text-sm text-blue-100 font-mulish">Gracias
                <span class="uppercase font-bold">{{$full_name}}</span>,
                en la franja horaria seleccionada
                <span class="uppercase font-bold">{{$initial_communication_time}} - {{$end_communication_time}} </span>
                se pondrá en contacto contigo 
                <span class="uppercase font-bold">{{$experts}}</span>
            </p>
            <div class="space-x-4 bg-grey-5 py-4 text-center">
                <button onclick="window.location='{{ URL::route('form'); }}'" class="inline-block rounded-md bg-turquoise-100 px-6 py-2 font-semibold text-blue-100 shadow-md duration-75 hover:bg-turquoise-110 font-mulish">Volver al formulario</button>
            </div>
        </div>
    </div>
</body>

</html>