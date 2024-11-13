<?php

namespace App\Http\Controllers;

use App\Models\Marker; 
use Illuminate\Http\JsonResponse;

class MapController extends Controller
{
    public function getMarkers(): JsonResponse
    {
        // Fetch markers from the database
        $markers = Marker::all();

        // Return markers as JSON
        return response()->json($markers);
    }
}

