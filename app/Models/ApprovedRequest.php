<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovedRequest extends Model
{
    use HasFactory;

    protected $table = 'approved_request';
    public $timestamps = false; 
    protected $fillable = [
        'shipment_id', 'fname', 'lname', 'phone', 'email',
        'street', 'brgy', 'city', 'province', 'zipcode',
        'region', 'origin', 'destination', 'category',
        'length', 'width', 'height', 'weight', 'dispatch_date'
    ];
}
