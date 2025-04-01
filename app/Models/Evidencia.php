<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evidencia extends Model
{
    use HasFactory;

    protected $fillable = ['pedido_id', 'imagen', 'tipo']; // tipo puede ser 'carga' o 'entrega'

    // Una evidencia pertenece a un pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
