<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'user_id',
    ];
    

    /**
     * Relación: Un post pertenece a un usuario.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accesor para obtener la URL completa de la imagen.
     *
     * @return string
     */
    public function getImageUrlAttribute($value): string
    {
        return $value ? Storage::disk('s3')->url($value) : '';
    }
    
    
}
