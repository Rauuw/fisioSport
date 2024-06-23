<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RutinaEjercicio extends Model
{
    use HasFactory;

    protected $table = 'rutina_ejercicio';

    protected $fillable = [
        'accion', 'fecha', 'tiempo_ejercicio', 'cantidad_repeticiones', 'motivo'
    ];

    public function rutina()
{
    return $this->belongsToMany(Rutina::class, 'rutina_ejercicio', 'ejercicio_id', 'rutina_id')
                ->withPivot('accion', 'fecha', 'paciente_id');
}

    public function ejercicio()
    {
        return $this->belongsToMany(Ejercicio::class, 'rutina_ejercicio', 'rutina_id', 'ejercicio_id')
                    ->withPivot('accion', 'fecha', 'paciente_id');
    }
    
}
