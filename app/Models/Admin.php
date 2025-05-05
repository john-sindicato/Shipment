<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin'; // Specify guard for authentication

    protected $table = 'admin';

    protected $fillable = ['fname', 'lname', 'email', 'password']; // Fields that can be filled

    protected $hidden = ['password', 'remember_token'];
}
