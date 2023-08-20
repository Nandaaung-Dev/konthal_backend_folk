<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','type_id','slug'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function type() {
        return $this->belongsTo(Type::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['type_id']) && $type_id = $filters['type_id']) {
            $query->where('type_id', $type_id);
        }
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
