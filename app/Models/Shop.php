<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'name_mm', 'phone_number', 'address', 'description', 'shop_type_id', 'owner_id', 'city_id', 'township_id', 'slug'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function creatable()
    {
        return $this->morphTo();
    }
    public function shop_type()
    {
        return $this->belongsTo(ShopType::class,);
    }
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function township()
    {
        return $this->belongsTo(Township::class);
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function shop_staffs()
    {
        return $this->hasMany(ShopStaff::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['owner_id']) && $owner_id = $filters['owner_id']) {
            $query->where('owner_id', $owner_id);
        }
        if (isset($filters['city_id']) && $city_id = $filters['city_id']) {
            $query->where('city_id', $city_id);
        }
        if (isset($filters['township_id']) && $township_id = $filters['township_id']) {
            $query->where('township_id', $township_id);
        }
        if (isset($filters['shop_type_id']) && $shop_type_id = $filters['shop_type_id']) {
            $query->where('shop_type_id', $shop_type_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
