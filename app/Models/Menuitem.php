<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    use HasFactory;
    protected $fillable = ['title_en','title_bn','name_en','name_bn','slug_en','slug_bn','type','target','menu_id','created_at','updated_at']; 
}
