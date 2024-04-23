<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historial';

    protected $fillable = [
        'fecha_creaciom',
    ];
    
    public function paciente()
    {
        return $this->belongsToMany(Paciente::class, 'paciente_historial', 'fisioterapeuta_id', 'paciente_id');
    }
}
