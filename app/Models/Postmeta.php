<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postmeta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'postmetas';
    public $timestamps = true;
      protected $fillable = ['id','cat_id','post_id'];

    public function metareletion()
    {
          return $this->belongsTo(Category::class, 'id');
    }

}
