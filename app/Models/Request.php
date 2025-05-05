<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model {
    use HasFactory;

    protected $table = 'request';
    public $timestamps = false; 
    protected $fillable = [
        'shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 'brgy',
        'city', 'province', 'zipcode', 'region', 'origin', 'destination',
        'category', 'length', 'width', 'height', 'weight'
    ];
}
