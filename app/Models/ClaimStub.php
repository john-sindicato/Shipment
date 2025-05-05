<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimStub extends Model
{
    use HasFactory;

    protected $table = 'claim_stub';  
    public $timestamps = false;
    protected $fillable = [
        'shipment_id',
        'fname',
        'lname',
        'phone',
        'email',
        'expected_delivery_date',
        'status'
    ];
}
