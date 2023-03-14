<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hitlog extends Model
{
    use HasFactory;
    protected $table = 'hitlogs';
	public $timestamps = true;
    protected $fillable = ['ip', 'view', 'browser','link','spent_time'];
}
