@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Título principal -->
    <div class="py-8 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900">Publicaciones de {{ auth()->user()->name }}</h1>
        <p class="text-gray-500 mt-2">Explora tus publicaciones recientes y crea más contenido.</p>
    </div>

    <!-- Publicaciones -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($posts as $post)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Imagen de la publicación -->
                @if ($post->image_url)
                    <img src="{{ $post->image_url }}" alt="Imagen de {{ $post->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Sin imagen</span>
                    </div>
                @endif

                <!-- Contenido de la publicación -->
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-500 text-sm mb-4">Publicado el <time datetime="{{ $post->created_at }}">{{ $post->created_at->format('d M Y') }}</time></p>
                    <p class="text-gray-700 mb-4 line-clamp-3">{{ $post->description }}</p>

                    <!-- Botón para más detalles -->
                    <a href="#" class="text-blue-600 hover:underline font-medium">
                        Leer más &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center">
                <p class="text-gray-600">No tienes publicaciones aún. <a href="{{ route('posts.create') }}" class="text-blue-600 hover:underline">¡Crea tu primera publicación!</a></p>
            </div>
        @endforelse
    </div>
</div>
@endsection
