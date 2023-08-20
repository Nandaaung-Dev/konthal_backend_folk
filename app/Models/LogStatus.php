<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogStatus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'name_mm', 'serial', 'color'];
    public function creatable()
    {
        return $this->morphTo();
    }
}
