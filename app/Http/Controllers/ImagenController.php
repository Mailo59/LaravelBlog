<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // Validar el archivo
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Subir el archivo al bucket S3 en una ubicación temporal
        $tempPath = 'temp/';
        $fileName = uniqid() . '-' . $request->file('file')->getClientOriginalName();
        $filePath = $tempPath . $fileName;

        try {
            $request->file('file')->storeAs($tempPath, $fileName, 's3');
            $fileUrl = Storage::disk('s3')->url($filePath);

            // Retornar la URL al frontend
            return response()->json([
                'archivo' => $filePath,
                'url' => $fileUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
