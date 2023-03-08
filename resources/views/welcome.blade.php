<!DOCTYPE html>
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
    <div class="flex-row justify-center items-center my-12">
        @if (Session::has('duplicado'))
            <div class="bg-red-100 border border-red-110 text-grey-5 px-4 py-3 rounded relative my-5 mx-24" role="alert">
                <span class="block sm:inline text-sm pr-4 font-mulish">{{ Session::get('duplicado') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

        <form id="form_registro" method="post" action="{{route('solicitud.store')}}" class="bg-white m-auto shadow-md rounded px-8 pt-6 pb-8 w-2/6 drop-shadow-lg" >
            @csrf
            <div class="flex-row row justify-center mb-8">
                <h1 class="text-2xl text-blue-100 font-bold tracking-tight  text-center w-full">Te ayudamos a encontrar tu hipoteca. </h1>
                <h4 class="text-s text-blue-100 tracking-tight text-center w-full">Uno de nuestros expertos te llamará para estudiar tu perfil y ayudarte a conseguir las mejores ofertas del mercado</h4>
            </div>
            <div class="mb-2">
                <label class="block text-base mb-2 text-blue-100 font-mulish tracking-tight" for="full_name">
                    Nombre y apellidos
                </label>
                <input id="full_name" name="full_name" type="text" placeholder="Ej. Mi nombre y apellidos" value="{{ old('full_name') }}" required class="font-mulish tracking-tight text-base shadow appearance-none border rounded w-full py-3 px-3 text-gray-130  mb-3 leading-tight focus:outline-none focus:shadow-outline border-blue-100 hover:bg-grey-10" >
                <span id="error-full_name" class="font-mulish tracking-tight text-sm text-red-110"></span>
            </div>

            <div class="mb-2">
                <label class="block text-base mb-2 text-blue-100 font-mulish tracking-tight" for="email">
                    Email
                </label>
                <input id="email" name="email" type="email" placeholder="Ej. micorreo@correo.com" required class="font-mulish tracking-tight text-base shadow appearance-none border border-blue-100 rounded w-full py-3 px-3 text-gray-130 mb-3 leading-tight focus:outline-none focus:shadow-outline hover:bg-grey-10">
                <span id="error-email" class="font-mulish tracking-tight text-sm text-red-110"></span>
            </div>

            <div class="mb-2">
                <label class="block text-base mb-2 text-blue-100 font-mulish tracking-tight" for="tlf">
                    Teléfono
                </label>
                <input  id="tlf" name="tlf" type="tel" placeholder="Ej. 786624731" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required  class="font-mulish tracking-tight text-base shadow appearance-none border border-blue-100 rounded w-full py-3 px-3 text-gray-130 mb-3 leading-tight focus:outline-none focus:shadow-outline hover:bg-grey-10" >
                <span id="error-tlf" class="font-mulish tracking-tight text-sm text-red-110"></span>
            </div>

            <div>
                <label class="block text-base mb-2 text-blue-100 font-mulish tracking-tight" for="neto">
                    Ingresos netos
                </label>
                <div class="input-wrapper">
                    <input id="neto" name="neto" type="number" min="20000" max="100000" placeholder="Ej. 30.000" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required class="font-mulish tracking-tight text-base shadow appearance-none border border-blue-100 rounded w-full py-3 px-3 text-gray-130 mb-3 leading-tight focus:outline-none focus:shadow-outline hover:bg-grey-10" >
                    <span class="input-icon text-base text-blue-100 font-mulish tracking-tight font-bold">€</span>
                </div>
                <input  id="range-neto" type="range" min="20000" max="100000" value="20000" step="1" class="w-full">
                <span id="error-neto" class="font-mulish tracking-tight text-sm text-red-110"></span>
            </div>

            <div>
                <label class="block text-base mb-2 text-blue-100 font-mulish tracking-tight" for="cantidad">
                    Cantidad solicitada
                </label>
                <div class="input-wrapper">
                    <input id="cantidad" name="cantidad" type="number" min="20000" max="1000000" step="100" placeholder="Ej. 300.000" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required class="font-mulish tracking-tight text-base shadow appearance-none border border-blue-100 rounded w-full py-3 px-3 text-gray-130 mb-3 leading-tight focus:outline-none focus:shadow-outline hover:bg-grey-10" >
                    <span class="input-icon text-base text-blue-100 font-mulish tracking-tight font-bold">€</span>
                </div>
                <input id="range-cantidad" type="range" min="20000" max="1000000" value="20000" step="100" class="w-full">
                <span id="error-cantidad" class="font-mulish tracking-tight text-sm text-red-110"></span>
            </div>

            <div class="mb-6 ">
                <p class="block text-base mb-2 text-blue-100 font-mulish tracking-tight"> Franja horaria para comunicarnos contigo</p>
                <div class="flex-row ml-3">
                    <div class="flex-row justify-start text-blue-100 mb-2">
                        <label class="text-base mb-2 text-blue-100 font-mulish tracking-tight mr-5 mt-2" for="time_desde">
                            Desde
                        </label>
                        <input type="time" id="time_desde" name="time_desde" required class=" w-1/2 block hover:bg-grey-10 text-base text-blue-100 border border-blue-100 rounded py-3 px-3 text-center w">
                        <span id="error-desde" class="font-mulish tracking-tight text-sm text-red-110"></span>
                    </div>
                    
                    <div class="flex-row justify-start text-blue-100">
                        <label class="text-base mb-2 text-blue-100 font-mulish tracking-tight mr-5 mt-2" for="time_hasta">
                            Hasta
                        </label>
                        <input type="time" id="time_hasta" name="time_hasta" class=" w-1/2 block hover:bg-grey-10 text-base text-blue-100 border border-blue-100 rounded py-3 px-3 text-center">
                        <span id="error-hasta" class="font-mulish tracking-tight text-sm text-red-110"></span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center w-full">
                <button id="btn_solicitar" class="bg-turquoise-100 tracking-tight hover:bg-turquoise-110 text-blue-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline text-base font-mulish"  type="button">
                    Solicitar hipoteca
                </button>
            </div>
        </form>
    </div>
</body>

</html>

