<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnclaimShipment extends Model
{
    use HasFactory;

    protected $table = 'unclaim_shipment';

    protected $fillable = [
        'shipment_id',
        'fname',
        'lname',
        'phone',
        'email',
        'street',
        'brgy',
        'city',
        'province',
        'zipcode',
        'region',
        'origin',
        'destination',
        'category',
        'length',
        'width',
        'height',
        'weight',
        'dispatch_date',
        'arrival_date'
    ];

    public $timestamps = false;  
}
