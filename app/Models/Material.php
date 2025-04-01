<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'cantidad_stock'];

    // Relación muchos a muchos con pedidos
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class)->withPivot('cantidad')->withTimestamps();
    }
}
