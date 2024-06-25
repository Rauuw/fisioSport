<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'fecha_nacimiento', 'genero', 'telefono', 'user_id', 'fisioterapeuta_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Fisioterapeuta()
    {
        return $this->belongsTo(Fisioterapeuta::class,'fisioterapeuta_id');
    } 

    public function notificaciones()
    {
        return $this->hasMany(Notificaciones::class, 'id');
    }

    public function historial()
    {
        return $this->hasOne(Historial::class, 'id');
    }
}
