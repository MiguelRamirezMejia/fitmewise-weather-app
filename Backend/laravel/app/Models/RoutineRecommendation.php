<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineRecommendation extends Model
{
    use HasFactory;
    protected $fillable = ['weather', 'recommendation'];
}
