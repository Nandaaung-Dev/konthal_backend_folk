<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['city_id','name','slug','shop_id','shop_type_id','township_id','address','name_mm','phone_number','description'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function shop_type() {
        return $this->belongsTo(ShopType::class);
    }
    public function shop() {
        return $this->belongsTo(Shop::class);
    }
    public function city() {
        return $this->belongsTo(City::class);
    }
    public function township() {
        return $this->belongsTo(Township::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['shop_id']) && $shop_id = $filters['shop_id']) {
            $query->where('shop_id', $shop_id);
        }
        if (isset($filters['shop_type_id']) && $shop_type_id = $filters['shop_type_id']) {
            $query->where('shop_type_id', $shop_type_id);
        }
        if (isset($filters['city_id']) && $city_id = $filters['city_id']) {
            $query->where('city_id', $city_id);
        }
        if (isset($filters['tonwship_id']) && $tonwship_id = $filters['tonwship_id']) {
            $query->where('tonwship_id', $tonwship_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
