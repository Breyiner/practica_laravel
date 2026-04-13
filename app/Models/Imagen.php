<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen extends Model
{
    use SoftDeletes;

    protected $table = 'imagenes';

    protected $fillable = [
        'ruta',
        'imageable_id',
        'imageable_type'
    ];


    public function imagenable(): MorphTo
    {
        return $this->morphTo();
    }
}
