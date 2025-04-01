<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'numero_factura', 'cliente_id', 'user_id', 'estado',
        'fecha_pedido', 'direccion_entrega', 'notas', 'activo'
    ];

    // Un pedido pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Un pedido fue registrado por un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación muchos a muchos con materiales
    public function materiales()
    {
        return $this->belongsToMany(Material::class)->withPivot('cantidad')->withTimestamps();
    }

    // Un pedido puede tener muchas evidencias
    public function evidencias()
    {
        return $this->hasMany(Evidencia::class);
    }
}
