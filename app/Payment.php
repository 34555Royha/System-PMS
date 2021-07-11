<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = array('product_id','invoice_id','qty','price','discount','total');

    public function product() {
        return $this->belongsTo(Post::class);
    }
}
