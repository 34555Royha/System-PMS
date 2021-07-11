<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spouse extends Model
{
    protected $fillable = array('name','employee_id','sex','address','DOB','phone');

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
