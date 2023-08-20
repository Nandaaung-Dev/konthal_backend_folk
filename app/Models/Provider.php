<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = ['name','phone','email','address','city_id','township_id','provider_branches_id'];
    
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
    public function provider_branches()
    {
        return $this->hasMany(ProviderBranche::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['city_id']) && $city_id = $filters['city_id']) {
            $query->where('city_id', $city_id);
        }
        if (isset($filters['township_id']) && $township_id = $filters['township_id']) {
            $query->where('township_id', $township_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
