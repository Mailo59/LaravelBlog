@extends('layouts.app')
@section('cabecera')
    Login   
@endsection
@section('title')
<div class="w-full h-full flex justify-center items-center">
    <h1 id="typewriter" class="text-black text-6xl font-bold"></h1>
</div>
 @endsection
 
 @section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md border-solid border-2 bg-gradient-to-tr from-orange-300 to-pink-700">
        <form method="POST" action="{{ route('login') }}"> 
            @csrf

            @if(session('status'))
                <p class="bg-red-500 text-black p-3 rounded-lg text-center mb-5">{{ session('status') }}</p>
            @endif

            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-700 font-bold">
                    Email
                </label>
                <input type="email" id="email" name="email" placeholder="Tu Email"
                class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-700 font-bold">
                    Password
                </label>
                <input type="password" id="password" name="password" placeholder="Tu Password"
                class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                @error('password')
                <p class="text-red-500 my-2 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <input type="submit"
            value="Iniciar Sesión"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-black rounded-lg">

        </form>
        <div class="mt-4 text-center">
            <a id="registertxt" class="underline decoration-slate-500 font-bold uppercase text-gray-600 hover:text-gray-800" href="{{ route('register')}}">Crear Cuenta</a>
        </div>
    </div>
</div>
@endsection
