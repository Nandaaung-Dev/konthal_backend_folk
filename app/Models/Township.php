<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Township extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','name_mm','city_id'];

    public function city(){
        return $this->belongsTo(City::class);
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
    
}
