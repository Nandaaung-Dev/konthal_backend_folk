<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['shipping_address', 'billing_address', 'customer_id'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function customer()
    {
        return $this->belongsTo((Customer::class));
    }
}
