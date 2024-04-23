<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;
    protected $table = 'ejercicio';

    protected $fillable = [
        'nombre', 'duracion','descripcion','repeticiones','url_video_demostrativo',
    ];

    public function rutina()
    {
        return $this->belongsToMany(Rutina::class, 'rutina_ejercicio',  'ejercicio_id' , 'rutina_id');
    }
}
