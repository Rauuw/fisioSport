<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = 'roles';

    protected $fillable = [
        'nombre',
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }
}
