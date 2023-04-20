<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Vehicules/Index');
});

Route::get('/search', function () {
    return Inertia::render('Vehicules/Search');
});


// ...

Route::get('/{query}', function ($query) {
    try {
        // Adding API key and query parameters
        $params = http_build_query([
            'access_token' => env('API_KEY'),
            // ... add other query parameters here as needed
        ]);

        // Call the external API using Laravel's built-in HTTP client
        $results = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$query}.json?{$params}");

        // Format the response data to include city and state
        $data = $results->json();
        foreach ($data['features'] as &$item) {
            foreach ($item['context'] as $type) {
                if (strpos($type['id'], 'place') !== false) {
                    $item['city'] = $item['text'];
                }
                if (strpos($type['id'], 'region') !== false) {
                    $item['state'] = $item['text'];
                }
            }
        }

        return response()->json($data);
    } catch (\Exception $error) {
        return response()->json(['error' => $error->getMessage()], 500);
    }
})->where('query', '.*');
