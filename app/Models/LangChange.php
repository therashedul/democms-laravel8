<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LangChange extends Model
{
    use HasFactory;
    protected $fillable =[
        'deshboard_en',
        'about_en',
        'categories_en',
        'comment_en',
        'popular_en',
        'trending_en',
        'latest_en',
        'reletive_en',
        'tags_en',
        'sidebar_en',
        'footer_en', 
        'more_en', 
        'download_en', 
        'subscriber_en', 
        
        'deshboard_bn',
        'about_bn',
        'categories_bn',
        'comment_bn',
        'popular_bn',
        'trending_bn',
        'latest_bn',
        'reletive_bn',
        'tags_bn',
        'sidebar_bn',
        'footer_bn',
        'more_bn',
        'download_bn',
        'subscriber_bn',
    ];
}
