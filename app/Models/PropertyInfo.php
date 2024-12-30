<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyInfo extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propertyPost()
    {
        return $this->hasOne(PropertyPost::class);
    }

    public function unitPhotos()
    {
        return $this->hasMany(UnitPhotos::class);
    }
}
