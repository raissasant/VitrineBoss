<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    protected $fillable = ['nome', 'logo_url'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
