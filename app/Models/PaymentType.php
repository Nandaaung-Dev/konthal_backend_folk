<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','name_mm'];
    public function creatable()
    {
        return $this->morphTo();
    }
    public function scopeSearch($query, $search)
    {
        if (isset($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('name_mm', 'LIKE', "%{$search}%");
        }
    }
}
