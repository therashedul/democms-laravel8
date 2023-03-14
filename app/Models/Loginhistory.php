<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loginhistory extends Model
{
    use HasFactory;
    protected $table = 'loginhistories';
    public $timestamps = true;
    protected $fillable = ['user_id', 'ip','reason'];

    // public function userparent()
	//     {
	//         return $this->belongsTo(User::class, 'id');
	//     }
}
