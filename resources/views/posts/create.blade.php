@extends('layouts.app')

@section('title')
    Crear Publicación
@endsection

@section('content')
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush    

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="flex flex-wrap items-start max-w-4xl shadow-xl rounded-lg bg-white overflow-hidden">
            <!-- Dropzone -->
            <div class="w-full md:w-1/2 px-6 py-8 bg-gray-50">
                <form 
                action="{{route('imagenes.store')}}"
                method="POST"
                enctype="multipart/form-data"
                id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center mt-10">
                @csrf
                </form>
            </div>

            <!-- Formulario -->
            <div class="w-full md:w-1/2 p-8">
                <form action="{{route('posts.store')}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="titulo" class="mb-2 block uppercase text-gray-600 font-bold">
                            Título
                        </label>
                        <input type="text" id="titulo" name="titulo" placeholder="Título de la Publicación"
                        class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" value="{{old('titulo')}}">
                        @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>                        
                        @enderror
                    </div>
        
                    <div class="mb-5">
                        <label for="descripcion" class="mb-2 block uppercase text-gray-600 font-bold">
                            Descripción de la Publicación
                        </label>
                        <textarea
                         id="descripcion" name="descripcion" placeholder="Descripción de la Publicación"
                        class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">{{old('descripcion')}}</textarea>
                        @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>                        
                        @enderror
                    </div>
        
                    <div class="mb-5">
                    <input type="hidden" id="imagen" name="imagen" value="{{ old('imagen') }}">
                        @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>                        
                        @enderror
                    </div>
        
                    <input type="submit"
                    value="Publicar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-black rounded-lg">
        
                </form>
            </div>
        </div>
    </div>
@endsection
