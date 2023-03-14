<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = [
        'title_en',
        'name_en',
        'slug_en',
        'excerpt_en',
        'content_en',
        'meta_description_en',
        'meta_keywords_en',
   
        
        'title_bn',
        'name_bn',
        'slug_bn',
        'excerpt_bn',
        'content_bn',
        'meta_description_bn',
        'meta_keywords_bn',
        
        'tag',
        'image',
        'file',
        'video',
        'link',
        'status',
        'slider',
        'trending',
        'template',
        'publish_at',
        'views',
        'privateshow',
        'user_id'];

    public function user() {
            return $this->belongsTo(User::class, 'id');
        }
    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id')->orderBy('id','desc');  //->orderBy('id','desc')
    }

}
