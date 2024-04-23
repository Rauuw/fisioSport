<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisioterapeuta extends Model
{
    use HasFactory;
    protected $table = 'fiseoterapeutas';

    protected $fillable = [
        'especialidad', 'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id');
    }
    public function notificaciones()
    {
        return $this->hasMany(Notificaciones::class, 'id');
    }

    public function rutinas()
    {
        return $this->hasMany(Rutina::class, 'id');
    }

    
}
