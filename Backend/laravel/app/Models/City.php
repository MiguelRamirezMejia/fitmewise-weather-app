<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id'];

    // Relación: Una ciudad pertenece a un país
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
