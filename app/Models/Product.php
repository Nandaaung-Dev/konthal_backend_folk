<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'name_mm', 'slug', 'price', 'shop_id', 'category_id', 'branch_id', 'brand_id'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function main_category()
    {
        return $this->belongsTo(MainCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['shop_id']) && $filters['shop_id'] !== null && $shop_id = $filters['shop_id']) {
            $query->where('shop_id', $shop_id);
        }
    }
}
