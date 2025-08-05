<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clique extends Model
{
    protected $fillable = [
        'produto_id',
        'ip',
        'origem',
        'user_agent',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
