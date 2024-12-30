<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPost extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propertyInfo()
    {
        return $this->belongsTo(PropertyInfo::class);
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
