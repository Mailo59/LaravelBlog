<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function testUpload()
    {
        try {
            // Crea un archivo temporal
            $fileName = 'test-file.txt';
            $fileContent = 'Contenido de prueba';
            
            // Sube el archivo
            $result = Storage::disk('s3')->put($fileName, $fileContent);
    
            return response()->json(['success' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
