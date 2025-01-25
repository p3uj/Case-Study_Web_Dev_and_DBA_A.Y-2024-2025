<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BarangayController extends Controller
{
    public static function index()
    {
        // Check if the data is cached
        $barangays = Cache::get('sortedBarangayList');

        // If the data is already in the cache, return the cached value
        // otherwise, fetch the data from the external API, store it in the cache, and then return it
        if ($barangays){
            return $barangays;
        } else {
            // Make a GET request to fetch barangays from the external API
            $response = Http::timeout(90)->get("https://psgc.gitlab.io/api/barangays/");

            // Check if the response is successful
            if ($response->successful()){
                $barangays = $response->json();

                // Loop through the barangays and store only the 'code' and 'name' fields in the array
                $barangayList = [];
                foreach ($barangays as $barangay) {
                    $barangayList[] = [
                        'cityCode' => $barangay['cityCode'],
                        'name' => $barangay['name'],
                    ];
                }

                // Convert the array into Laravel Collection and sort by 'name'
                $sortedBarangayList = collect($barangayList)->sortBy('name');

                // After sorting, reset the array keys by using values() and use all() to return the final sorted array
                $sortedBarangayList = $sortedBarangayList->values()->all();

                // Store the sortedBarangayList data in cache for 1 year
                Cache::put('sortedBarangayList', $sortedBarangayList, now()->addYear(1));

                // Return sorted list of barangays
                return $sortedBarangayList;
            } else{
                // Access the status code and error message (if available)
                $statusCode = $response->status();  // Gets the HTTP status code
                $errorMessage = $response->body();  // Gets the raw response body

                // Optionally, if the response is in JSON format and contains an error message
                $errorJson = $response->json();  // Decodes the JSON response
                $errorMessage = $errorJson['message'] ?? 'Unknown error';  // Safely get the error message if available

                return "Error: Status Code {$statusCode} - {$errorMessage}";
            }
        }
    }
}
