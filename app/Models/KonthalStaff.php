<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KonthalStaff extends Model
{
    use HasFactory,SoftDeletes;
    public function creatable()
    {
        return $this->morphTo();
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
