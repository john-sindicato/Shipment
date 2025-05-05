<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    use HasFactory;

    protected $table = 'shipping_rate';

    protected $fillable = [
        'origin',
        'destination',
        'price',
        'delivery_days',
        'status',
    ];
    public $timestamps = false;
}
