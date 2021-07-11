<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Post extends Model
{
    protected $fillable = array('category_id','name','qty','price','discounts','image','short_desc','description');


    public function category() {
        return $this->belongsTo(Category::class);
    }
}
