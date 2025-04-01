<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'rol_id', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Un usuario puede registrar muchos pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    // Un usuario pertenece a un rol o departamento
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
