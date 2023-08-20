<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopDepartment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'name_mm', 'shop_id'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['shop_id']) && $shop_id = $filters['shop_id']) {
            $query->where('shop_id', $shop_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
