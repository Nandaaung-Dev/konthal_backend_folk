<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopStaff extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'shop_staffs';
    protected $fillable = ['name', 'username', 'email', 'password', 'address', 'phone_number', 'shop_id', 'branch_id', 'shop_department_id', 'city_id', 'township_id'];
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
    public function shop_department()
    {
        return $this->belongsTo(ShopDepartment::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['city_id']) && $city_id = $filters['city_id']) {
            $query->where('city_id', $city_id);
        }
        if (isset($filters['township_id']) && $township_id = $filters['township_id']) {
            $query->where('township_id', $township_id);
        }
        if (isset($filters['shop_id']) && $shop_id = $filters['shop_id']) {
            $query->where('shop_id', $shop_id);
        }
        if (isset($filters['branch_id']) && $branch_id = $filters['branch_id']) {
            $query->where('branch_id', $branch_id);
        }
        if (isset($filters['department_id']) && $department_id = $filters['department_id']) {
            $query->where('department_id', $department_id);
        }
    }


    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
