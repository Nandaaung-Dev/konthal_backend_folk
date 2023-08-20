<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name_mm', 'name','region_id'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    // Scope 
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['region_id']) && $region_id = $filters['region_id']) {
            $query->where('region_id', $region_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
