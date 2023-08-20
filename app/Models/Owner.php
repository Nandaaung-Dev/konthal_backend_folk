<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Owner extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;
    protected $fillable = ['id', 'name', 'username', 'email', 'password', 'address', 'phone_number', 'city_id', 'township_id'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function township()
    {
        return $this->belongsTo(Township::class);
    }
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['city_id']) && $city_id = $filters['city_id']) {
            $query->where('city_id', $city_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
    public function created_branches()
    {
        return $this->morphMany(Branch::class, 'creatable');
    }
    public function created_categories()
    {
        return $this->morphMany(Category::class, 'creatable');
    }
    public function updated_branches()
    {
        return $this->morphMany(Branch::class, 'updatable');
    }
    public function created_providers()
    {
        return $this->morphMany(Provider::class, 'creatable');
    }
    public function created_provider_branches()
    {
        return $this->morphMany(ProviderBranche::class, 'creatable');
    }
}
