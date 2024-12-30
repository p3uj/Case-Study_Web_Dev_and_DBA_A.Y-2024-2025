<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPhotos extends Model
{
    use HasFactory;

    public function propertyInfo()
    {
        return $this->belongsTo(PropertyInfo::class);
    }
}
