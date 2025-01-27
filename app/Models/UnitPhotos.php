<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnitPhotos extends Model
{
    use HasFactory;

    public function propertyInfo()
    {
        return $this->belongsTo(PropertyInfo::class);
    }

    // Retrieve all unit photos of the property post based on the property info id
    public static function getAllUnitPhotosById($propertyInfoId) {
        $unitPhotos = DB::select('RE_SP_GET_ALL_PHOTOS_BY_ID ?', [$propertyInfoId]);

        $unitPhotos = collect($unitPhotos);

        return $unitPhotos;
    }
}
