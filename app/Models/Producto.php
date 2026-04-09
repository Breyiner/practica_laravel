<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'productos';
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'activo'
    ];
    
    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    protected $hidden = [];
}
