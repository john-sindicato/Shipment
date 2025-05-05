<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company_contact_details';  
    protected $fillable = ['address', 'phone', 'email'];
    public $timestamps = false;
}
