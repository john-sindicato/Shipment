<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teller extends Authenticatable {
    use HasFactory;

    protected $table = 'teller';
    protected $fillable = [
        'fname', 'lname', 'dob', 'gender', 'phone', 'email', 'street', 
        'brgy', 'city', 'province', 'zipcode', 'branch', 'profile', 'password', 'status'
    ];    

    protected $hidden = ['password'];
    public $timestamps = false;
}