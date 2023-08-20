<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug', 'shop_id', 'name_mm', 'main_category_id'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function scopeFilter($query, array $filters)
    {
        return $this->belongsTo(MainCategory::class);
    }
}
