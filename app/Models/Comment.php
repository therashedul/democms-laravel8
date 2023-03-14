<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    use HasFactory;
       protected $fillable = ['user_id', 'post_id', 'parent_id', 'comment_body','commentname','commentemail','status','deleted_at','created_at','updated_at'];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
   
    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
