@extends('layouts.app')

@section('cabecera')
    Registro
@endsection

@section('title')
<h1 class="flex justify-center mb-10 font-bold text-3xl text-gray-800">Bienvenidos al Registro de Uvgstagram</h1>
@endsection

@section('content') 
<div class="flex justify-center items-center h-full">
    <div class="w-full max-w-md border bg-white p-8 rounded-lg shadow-md">
        <form method="POST" action="{{ route('register') }}"> 
            @csrf

            <!-- Nombre -->
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-700 font-bold">
                    Nombre
                </label>
                <input type="text" id="name" name="name" placeholder="Tu Nombre"
                class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                @error('name')  
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>                        
                @enderror
            </div>

            <!-- Username -->
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-700 font-bold">
                    Username
                </label>
                <input type="text" id="username" name="username" placeholder="Tu Nombre de Usuario"
                class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}">
                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>                        
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-700 font-bold">
                    Email
                </label>
                <input type="email" id="email" name="email" placeholder="Tu Email"
                class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>                        
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-700 font-bold">
                    Password
                </label>
                <input type="password" id="password" name="password" placeholder="Tu Password"
                class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>                        
                @enderror
            </div>

            <!-- Confirmar Password -->
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-700 font-bold">
                    Repetir Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite Tu Password"
                class="border p-3 w-full rounded-lg">
            </div>

            <!-- Botón Crear Cuenta -->
            <input type="submit"
            value="Crear Cuenta"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>

        <!-- Link a iniciar sesión -->
        <div class="mt-4 text-center">
            <a id="registertxt" class="underline decoration-slate-500 font-bold text-gray-600" href="{{ route('login') }}">
                ¿Ya tienes una cuenta?
            </a>
        </div>
    </div>
</div>
@endsection
