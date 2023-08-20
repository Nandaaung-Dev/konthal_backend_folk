<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'name_mm', 'slug', 'category_id',];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
