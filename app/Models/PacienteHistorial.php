<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteHistorial extends Model
{
    use HasFactory;
    protected $table = 'paciente_historial';

    protected $fillable = [
        'fecha_creaciom', 'diagnostico', 'sintomas','paciente_id','historial_id',
    ];
    
    public function paciente()
    {
        return $this->belongsToMany(Paciente::class, 'paciente_historial', 'paciente_id', 'fisioterapeuta_id');
    }

    public function historial()
    {
        return $this->belongsToMany(Historial::class, 'paciente_historial', 'fisioterapeuta_id', 'paciente_id');
    }
}
