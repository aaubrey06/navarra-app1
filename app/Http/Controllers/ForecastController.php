<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Dcvn\Math\Statistics\MovingAverage;
use Carbon\Carbon; 



class ForecastController extends Controller
{
    public function showDashboard()
    {
        return view('store_manager.forecast.dashboard');
    }


    public function uploadSalesData(Request $request)
    {
        $request->validate([
            'sales_data' => 'required|mimes:csv,txt|max:2048', 
        ]);


        $file = $request->file('sales_data');
        $filePath = $file->storeAs('sales_data', 'sales_data.csv'); 
        return back()->with('success', 'Sales data uploaded successfully');
    }

    
    public function forecastSales()
    {
        $inputCsv = storage_path('app/sales_data/sales_data.csv');
        $outputCsv = storage_path('app/forecast.csv');

        
        if (!file_exists($inputCsv)) {
            return back()->with('error', 'Sales data CSV file not found.');
        }

        
        $process = new Process([
            'python', 
            storage_path('app/scripts/arima_forecast.py'), 
            $inputCsv, 
            $outputCsv
        ]);
        
        $process->run();

        if (!$process->isSuccessful()) {
            \Log::error('Forecast process failed: ' . $process->getErrorOutput());
            throw new ProcessFailedException($process);
        }

        return redirect()->route('store_manager.forecast.index')->with('success', 'Forecast generated successfully');
    }

    
    public function getForecastData()
    {

        $outputCsv = storage_path('app/forecast.csv');
        
        if (!file_exists($outputCsv)) {
            return response()->json(['error' => 'Forecast data not found.']);
        }

        $forecastData = array_map('str_getcsv', file($outputCsv));
        array_shift($forecastData); 

        $dates = [];
        $forecastedSales = [];

        foreach ($forecastData as $row) {
            $dates[] = $row[0]; 
            $forecastedSales[] = (float) $row[1]; 
        }


        return response()->json([
            'dates' => $dates,
            'forecasted_sales' => $forecastedSales
        ]);
    }

    public function index()
    {
        return view('store_manager.forecast.index');
    }

    // MA
    public function showMovingAverage()
    {
        $movingAverages = [
            'weekly' => [20020, 30000, 200005, 300005, 20008, 32000, 40000],  
            'monthly' => [150000, 2000000, 1800000, 2200000, 250000, 2000070, 300000],  
            'yearly' => [20000000, 25000, 240000000, 26000000, 2800000],  
        ];
    
        $weeklyLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'];
        $monthlyLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        $yearlyLabels = ['2020', '2021', '2022', '2023', '2024'];
    
        return view('store_manager.forecasting.index', [
            'result' => $movingAverages,  
            'weeklyLabels' => $weeklyLabels,
            'monthlyLabels' => $monthlyLabels,
            'yearlyLabels' => $yearlyLabels
        ]);
    }
    

}
