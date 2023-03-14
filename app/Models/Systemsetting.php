<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Systemsetting extends Model
{
    use HasFactory;
    protected $fillable=['logo','fevicon','powerby','app_name','copyright'];
}