<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = array('InvoiceDate','ExpiredDate','employee_id','customer_id');

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
