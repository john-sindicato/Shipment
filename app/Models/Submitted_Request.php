<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submitted_Request extends Model
{
    use HasFactory;

    protected $table = 'submitted_request';
    public $timestamps = false; 
    protected $fillable = [
        'shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 'brgy',
        'city', 'province', 'zipcode', 'region', 'origin', 'destination',
        'category', 'length', 'width', 'height', 'weight'
    ];
}