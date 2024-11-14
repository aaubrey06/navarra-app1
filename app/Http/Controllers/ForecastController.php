<?php

namespace App\Http\Controllers;

use App\Models\Data; 
use Dcvn\Math\Statistics\MovingAverage;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ForecastController extends Controller
{
    public function showMovingAverage()
{
    $data = Data::select('sales_date', 'quantity_sold')->orderBy('sales_date')->get();

    $windowSize = 5; 

    $movingAverage = new MovingAverage(array_column($data->toArray(), 'quantity_sold'), $windowSize);
    $movingAverages = $movingAverage->getMovingAverage();

    // Ensure data is an array of objects
    if (!$data->isEmpty() && $data->first() instanceof \Illuminate\Database\Eloquent\Model) {
        $data = $data->toArray();
    }

    return view('store_manager.forecasting.index', compact('data', 'movingAverages'));
}
public function showForecast(Request $request)
{
    // Get grouping option from request
    $groupBy = $request->input('group_by', 'none');

    // Fetch sales data
    $data = Data::select('sales_date', 'quantity_sold')->orderBy('sales_date')->get();

    // Group data based on selection
    $groupedData = $this->groupDataBy($data, $groupBy);

    // Calculate moving averages based on grouped data (as an example)
    $quantities = $groupedData->pluck('quantity_sold')->toArray();
    $windowSize = 5;
    $movingAverages = [];
    for ($i = 0; $i < count($quantities); $i++) {
        if ($i >= $windowSize - 1) {
            $average = array_sum(array_slice($quantities, $i - $windowSize + 1, $windowSize)) / $windowSize;
            $movingAverages[] = round($average, 2);
        } else {
            $movingAverages[] = null; // No moving average for initial periods
        }
    }

    return view('store_manager.forecasting.index', [
        'data' => $groupedData,
        'movingAverages' => $movingAverages,
        'groupBy' => $groupBy
    ]);
}

private function groupDataBy($data, $groupBy)
{
    switch ($groupBy) {
        case 'weekly':
            return $data->groupBy(function ($item) {
                return Carbon::parse($item['sales_date'])->startOfWeek()->format('Y-m-d');
            })->map(function ($group) {
                return [
                    'sales_date' => $group->first()['sales_date'],
                    'quantity_sold' => $group->sum(function($item) {
                        return (float) $item['quantity_sold']; // Explicitly cast to numeric value
                    }),
                ];
            })->values();
    
        case 'monthly':
            return $data->groupBy(function ($item) {
                return Carbon::parse($item['sales_date'])->format('Y-m');
            })->map(function ($group) {
                return [
                    'sales_date' => $group->first()['sales_date'],
                    'quantity_sold' => $group->sum(function($item) {
                        return (float) $item['quantity_sold']; // Explicitly cast to numeric value
                    }),
                ];
            })->values();
    
        case 'yearly':
            return $data->groupBy(function ($item) {
                return Carbon::parse($item['sales_date'])->format('Y');
            })->map(function ($group) {
                return [
                    'sales_date' => $group->first()['sales_date'],
                    'quantity_sold' => $group->sum(function($item) {
                        return (float) $item['quantity_sold']; // Explicitly cast to numeric value
                    }),
                ];
            })->values();
    
        default:
            return $data;
    }
}


}