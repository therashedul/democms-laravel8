<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    protected $table = 'pages';
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'title_en',
        'name_en', 
        'slug_en', 
        'content_en', 
        
        'title_bn',
        'name_bn', 
        'slug_bn', 
        'content_bn',

        'parent_id',
        'link',
        'image',
        'file',
        'video',
        'status',
        'privatepage',
        'publish_at',
        'views',
        'user_id',
        'template',
    ];
    
    public function subpage()
        {
            return $this->hasMany(Page::class, 'parent_id', 'id');
        }

    public function parent()
        {
            return $this->belongsTo(Page::class, 'parent_id');
        }
    public function user()
        {
            return $this->belongsTo(User::class, 'id');
        }

}
