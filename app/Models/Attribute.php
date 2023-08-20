<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['id','name','name_mm','shop_id']; 
    public function creatable()
    {
        return $this->morphTo();
    }
    public function shop() {
        return $this->belongsTo(Shop::class);
    }
    public function attribute_values()
    {
        return $this->hasMany(AttributeValue::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['shop_id']) && $shop_id = $filters['shop_id']) {
            $query->where('shop_id', $shop_id);
        }
    }
}
