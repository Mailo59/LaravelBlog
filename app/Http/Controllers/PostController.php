<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|image|max:2048', // Validar que sea una imagen y límite de tamaño
        ]);

        // Subir la imagen a S3
        $file = $request->file('file');
        $path = $file->store('uploads', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
        $imageUrl = Storage::disk('s3')->url($path);

        // Crear la publicación en la base de datos
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imageUrl,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Publicación creada con éxito.');
    }
        public function create()
         {
             return view('posts.create'); // Asegúrate de que la vista esté en resources/views/posts/create.blade.php
         }

}
