<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historial';

    protected $fillable = [
        'fecha_creacion',
        'historial',
        'paciente_id'
    ];
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
