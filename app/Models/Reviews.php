<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    public function propertyPost()
    {
        return $this->belongsTo(PropertyPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
