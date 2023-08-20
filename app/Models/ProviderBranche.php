<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderBranche extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['phone', 'name','email','address','city_id','township_id','provider_id'];
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
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['provider_id']) && $provider_id = $filters['provider_id']) {
            $query->where('provider_id', $provider_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
