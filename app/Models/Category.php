<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title_en','name_en', 'slug_en', 'title_bn','name_bn', 'slug_bn','parent_id','status','category_img','privatecat'];

    public function subcategory()
        {
            return $this->hasMany(Category::class, 'parent_id', 'id');
        }

    public function parent()
        {
            return $this->belongsTo(Category::class, 'parent_id');
        }

}
