<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_cart extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id','user_id','phone','address','email'];
}
