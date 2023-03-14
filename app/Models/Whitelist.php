<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    use HasFactory;
    protected $table = 'whitelists';
    public $timestamps = true;
    protected $fillable = ['user_id', 'ip'];
    public function userparent()
	    {
	        return $this->belongsTo(User::class, 'id');
	    }
}
