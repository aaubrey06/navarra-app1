<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\OrderStatus;


class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        return view('driver.schedule', compact('schedules')); 
    }
    public function getLocations()
    {
        $schedules = \DB::table('schedules')->select('location')->get();
        return response()->json($schedules);
    } 
    public function getOrdersAndSchedules()
    {
        $orders = Order::all();
        $schedules = Schedule::all(); // Assuming you have a Schedule model


        $data = [
            'orders' => $orders,
            'schedules' => $schedules
        ];

        return response()->json($data);
    }    
    public function updateStatus(Request $request)
    {
        $order = Schedule::find($request->order_id);

        if ($order) {
            $order->status = $request->status;
            $order->save();

            // Log the status in the `orderstatus` table
            OrderStatus::create([
                'order_id' => $request->order_id,
                'status' => $request->status,
                'reason' => $request->reason,
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}