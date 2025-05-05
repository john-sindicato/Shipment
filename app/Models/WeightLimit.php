<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLimit extends Model {
    use HasFactory;

    protected $table = 'weight_limit';
    public $timestamps = false;
    protected $fillable = ['weight'];
}
