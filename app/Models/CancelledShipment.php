<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledShipment extends Model
{
    use HasFactory;

    protected $table = 'cancelled_shipment';  
    public $timestamps = false;
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
        'cancel_reason',
        'cancelled_date',
    ];
}
