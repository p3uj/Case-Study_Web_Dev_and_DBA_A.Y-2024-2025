<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateConversion
{
    public static function formatDate($records, $dateColumn)
    {
        // Convert date to Carbon for formatting the date into readable format
        foreach ($records as $record) {
            $record->$dateColumn = Carbon::parse($record->$dateColumn); // Converting the date to a Carbon instance for easier date manipulation
            $record->$dateColumn = $record->$dateColumn->format('F d, Y \a\t h:i A'); // Formatting the date to Month, Day, Year, 'at', Time (AM/PM)
        }

        return $records;
    }
}
