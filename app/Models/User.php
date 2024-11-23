<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Los atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Los atributos que deben ocultarse para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Método boot para manejar eventos del modelo.
     */
    protected static function booted()
    {
        static::created(function ($user) {
            // Nombre de la carpeta que se creará en el bucket
            $folderName = "usuarios/{$user->id}/"; // Usa "{$user->name}/" si prefieres basarlo en el nombre del usuario

            try {
                // Intentar crear un archivo vacío en la carpeta para simular su existencia
                Storage::disk('s3')->put("$folderName.placeholder", ''); // "placeholder" asegura que S3 cree la estructura
            } catch (\Exception $e) {
                \Log::error("Error al crear carpeta en S3 para el usuario {$user->id}: {$e->getMessage()}");
            }
        });
    }
    public function posts()
{
    return $this->hasMany(Post::class);
}

}
