<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branch';  
    protected $fillable = ['province', 'address', 'contact_person', 'phone', 'email', 'status'];
    public $timestamps = false;
}
