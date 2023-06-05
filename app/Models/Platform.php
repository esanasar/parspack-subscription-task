<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function subscriptions() : HasMany
    {
        return $this->hasMany('\App\Models\subscription');
    }
}
