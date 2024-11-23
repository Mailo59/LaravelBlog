<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Aws\DynamoDb\DynamoDbClient;
use Aws\Lambda\LambdaClient;
use Aws\Sns\SnsClient;

class PostController extends Controller
{
    protected function notifySubscribers($post, $user)
{
    $lambda = new LambdaClient([
        'version' => 'latest',
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ]);

    try {
        $payload = [
            'post_title' => $post->title,
            'post_description' => $post->description,
            'user_name' => $user->name,
        ];

        $lambda->invoke([
           'FunctionName' => 'arn:aws:lambda:us-east-1:021891597097:function:Notify-Function',
            'InvocationType' => 'Event', // Asíncrono
            'Payload' => json_encode($payload),
        ]);

        Log::info('Notificación enviada a Lambda.');
    } catch (\Exception $e) {
        Log::error('Error al enviar notificación a Lambda', ['error' => $e->getMessage()]);
    }
}
public function store(Request $request)
{
    // Validar los campos del formulario
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'imagen' => 'nullable|string',
    ]);

    // Obtener el usuario logeado
    $user = auth()->user();

    // Crear el post
    $post = Post::create([
        'title' => $request->titulo,
        'description' => $request->descripcion,
        'image_url' => $request->imagen ?? 'https://via.placeholder.com/150', // Imagen por defecto
        'user_id' => $user->id,
    ]);

    // Enviar notificación a SNS
    try {
        $this->sendSnsNotification($user, $post);
        Log::info('Notificación enviada a SNS');
    } catch (\Exception $e) {
        Log::error('Error al enviar notificación a SNS', ['error' => $e->getMessage()]);
    }

    return redirect()->route('principal')->with('success', 'Publicación creada correctamente');
}

protected function sendSnsNotification($user, $post)
{
    $sns = new SnsClient([
        'version' => 'latest',
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ]);

    $message = "El usuario {$user->name} ha creado una nueva publicación: \"{$post->title}\"";

    $sns->publish([
        'TopicArn' => env('AWS_SNS_TOPIC_ARN'), // Configura esto en tu archivo .env
        'Message' => $message,
        'Subject' => 'Nueva publicación creada',
    ]);
}


    protected function logActivityToDynamoDB($user, $message)
    {
        $dynamoDb = new DynamoDbClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ]);

        $dynamoDb->putItem([
            'TableName' => 'UserActivity', // Asegúrate de que este nombre sea correcto
            'Item' => [
                'ClaveDB' => ['S' => uniqid()], // Clave primaria única para DynamoDB
                'UserId' => ['S' => (string)$user->id], // ID del usuario
                'Message' => ['S' => $message], // Mensaje de la actividad
                'Timestamp' => ['S' => now()->toIso8601String()], // Fecha y hora ISO 8601
            ],
        ]);
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        Log::info('Mostrando el formulario de creación de publicaciones');
        return view('posts.create'); // Asegúrate de que esta vista exista en `resources/views/posts/create.blade.php`
    }

    public function principal()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener las publicaciones del usuario
        $posts = Post::where('user_id', $user->id)->get();

        // Renderizar la vista principal con las publicaciones
        return view('principal', compact('posts'));
    }
}
