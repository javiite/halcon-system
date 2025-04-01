<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'numero_cliente', 'direccion', 'datos_fiscales'
    ];

    // Un cliente puede tener varios pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
