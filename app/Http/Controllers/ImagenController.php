<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // Validar el archivo
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,doc,docx,pdf,txt,zip|max:5120',
        ]);

        // Inicializar el cliente S3
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ]);

        // Obtener el archivo
        $file = $request->file('file');
        $fileName = uniqid() . '-' . $file->getClientOriginalName();
        $bucket = env('AWS_BUCKET', 'tu-bucket');

        try {
            // Subir el archivo al bucket
            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key' => "archivos/$fileName", // Carpeta 'archivos' en el bucket
                'SourceFile' => $file->getPathname(),
                'ACL' => 'public-read', // Si necesitas acceso público
            ]);

            // Retornar la URL del archivo
            return response()->json([
                'archivo' => $result['ObjectURL'],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
