<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public static function index()
    {
        // Check if the data is cached
        $cities = Cache::get('sortedCityList');

        // If the data is already in the cache, return the cached value
        // otherwise, fetch the data from the external API, store it in the cache, and then return it
        if ($cities){
            return $cities;
        } else {
            // Make a GET request to fetch cities from the external API
            $response = Http::get("https://psgc.gitlab.io/api/cities/");

            // Check if the response is successful
            if ($response->successful()){
                $cities = $response->json();

                // Loop through the cities and store only the 'code' and 'name' fields in the array
                $cityList = [];
                foreach ($cities as $city) {
                    $cityList[] = [
                        'code' => $city['code'],
                        'name' => $city['name'],
                    ];
                }

                // Convert the array into Laravel Collection and sort by 'name'
                $sortedCityList = collect($cityList)->sortBy('name');

                // After sorting, reset the array keys by using values() and use all() to return the final sorted array
                $sortedCityList = $sortedCityList->values()->all();

                // Store the sortedCityList data in cache for 24 hours
                Cache::put('sortedCityList', $sortedCityList, now()->addHours(24));

                // Return sorted list of cities
                return $sortedCityList;
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
