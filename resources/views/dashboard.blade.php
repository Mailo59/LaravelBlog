<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <link href="https://fonts.googleapis.com/css2?family=Helvetica+Neue:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>UvgStagram - @yield('cabecera')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-black">
    <header class="p-5 border-b-2 bg-black shadow shadow-gray-100">
        <div class="container mb-5 mx-auto flex justify-around items-center">
            <div class="mr-96 w-50 h-60 mn mtpn mt-0">
                <a href=""><img id="agregar" class="w-72 h-50" src="" alt="Logo uvgstagram"></a>
            </div>

            @auth
            <nav class="flex gap-2 mt-8  items-center">

                <a class="flex items-center gap-2 bg-gray-600 hover:bg-gray-300 border p-2 font-bold text-black rounded text-sm uppercase cursor-pointer"
                    href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                    Crear
                </a>

                <a class="font-bold text-xl  text-gray-600" href=""
                    <form method="POST" action="">
                    @csrf
                    <button class="font-bold uppercase text-gray-600" type="submit">Cerrar Sesión</button>
                    </form>
            </nav>
            @endauth

            @guest
            <nav class="flex gap-2 mt-8 mnl items-center">
                <a id="destruir" class="font-bold uppercase text-gray-600" href="">Login</a>
                <a id="destruir2" class="font-bold uppercase text-gray-600" href="">Crear Cuenta</a>
            </nav>
            @endguest



        </div>
    </header>
    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('title')
        </h2>
        @yield('content')


    </main>
    <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
        UvgStagram - Todos los derechos reservados &copy; 2023
    </footer>
</body>

</html>