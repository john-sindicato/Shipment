<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclinedRequest extends Model
{
    use HasFactory;

    protected $table = 'declined_request';
    public $timestamps = false; 
    protected $fillable = [
        'shipment_id', 'fname', 'lname', 'phone', 'email',
        'street', 'brgy', 'city', 'province', 'zipcode',
        'region', 'origin', 'destination', 'category',
        'length', 'width', 'height', 'weight', 'decline_reason', 'declined_date'
    ];
}
