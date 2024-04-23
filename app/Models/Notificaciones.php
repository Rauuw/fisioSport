<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'mensaje', 'fecha_envio', 'fisioterapeuta_id','paciente_id',
    ];

    public function fisioterapeuta()
    {
        return $this->belongsTo(Fisioterapeuta::class, 'fisioterapeuta_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
