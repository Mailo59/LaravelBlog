<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <title>LaravelBlog -  @yield('cabecera')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body class="bg-black">
    <header class="p-3 border-b-2 bg-black shadow shadow-gray-100">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo y texto -->
        <div class="flex items-center gap-4 ">
            <a href="{{ route('principal') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-48 h-16">
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FF832D"
                        d="M512 303.844c0 44.18-35.82 80-80 80h-32c-8.844 0-16-7.156-16-16s7.156-16 16-16h32c26.516 0 48-21.492 48-48s-21.484-48-48-48h-.25c-20.812 0-38.539-13.25-45.188-31.766-.047-.117-.156-.234-.195-.352-12.492-35.078-44.727-60.758-83.398-63.531-8.359.539-14.969 7.406-14.969 15.906v191.742c0 8.844-7.156 16-16 16s-16-7.156-16-16V176.102c0-26.32 21.156-47.617 47.398-47.945 52.242 2.984 95.961 37.297 112.891 84.438.078.078.234.156.258.234 2.094 6.398 8.102 11.016 15.203 11.016h.25c.891 0 1.766.102 2.656.141.156.014.391.014.524.014 42.711 1.688 76.82 36.734 76.82 79.844zm-304 80c-8.844 0-16-7.156-16-16v-176c0-8.844 7.156-16 16-16s16 7.156 16 16v176c0 8.844-7.156 16-16 16zm-64 0c-8.844 0-16-7.156-16-16V183.836c0-8.828 7.156-16 16-16s16 7.172 16 16v184.008c0 8.844-7.156 16-16 16zm-64 0c-8.844 0-16-7.156-16-16v-128c0-8.844 7.156-16 16-16s16 7.156 16 16v128c0 8.844-7.156 16-16 16zm-64-32c-8.844 0-16-7.156-16-16v-64c0-8.844 7.156-16 16-16s16 7.156 16 16v64c0 8.844-7.156 16-16 16zm320 0c8.844 0 16 7.156 16 16s-7.156 16-16 16-16-7.156-16-16 7.156-16 16-16z" />
                </svg>
            </a>
            <span class="text-xl text-black font-bold mr-9">BookCloud</span>
        </div>

        <!-- Navegación -->
        @auth
        <nav class="flex gap-4 items-center pr-4">
            <a class="flex items-center gap-2 bg-gray-600 hover:bg-gray-300 border p-2 font-bold text-black rounded text-sm uppercase cursor-pointer"
                href="{{ route('posts.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                </svg>
                Crear
            </a>
            <span class="font-bold text-lg text-gray-400">Hola: <span class="font-normal">{{ auth()->user()->name }}</span></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="font-bold uppercase text-gray-600" type="submit">Cerrar Sesión</button>
            </form>
        </nav>
        @endauth

        @guest
        <nav class="flex gap-6 items-center pr-4">
            <a id="destruir" class="font-bold uppercase text-gray-400 hover:text-gray-100" href="{{ route('login') }}">Login</a>
            <a id="destruir2" class="font-bold uppercase text-gray-400 hover:text-gray-100" href="{{ route('register') }}">Crear Cuenta</a>
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
            LaravelBlog - Todos los derechos reservados &copy; 2024
        </footer>
    </body>
</html>
