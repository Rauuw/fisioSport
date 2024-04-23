<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;
    protected $table = 'rutinas';

    protected $fillable = [
        'nombre', 'descripcion', 'fecha_creacion','fecha_modificacion','sesion', 'fisioterapeuta_id',
    ];

    public function fisioterapeuta()
    {
        return $this->belongsTo(User::class, 'fisioterapeuta_id');
    }

    public function ejercicio()
    {
        return $this->belongsToMany(Ejercicio::class, 'rutina_ejercicio', 'rutina_id', 'ejercicio_id');
    }
}
