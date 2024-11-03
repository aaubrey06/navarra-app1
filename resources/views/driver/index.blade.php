<!-- resources/views/orders/index.blade.php -->
@extends('layouts.driver_layout')

@section('title', 'Orders List')

@section('contents')
    <h1>Orders</h1>
    <ul>
        @foreach($orders as $order)
            <li>
                Order ID: {{ $order->id }} <br>
                Schedule Time: {{ $order->schedule->delivery_time }} <br>
                Driver Name: {{ $order->driver->name }}
            </li>
        @endforeach
    </ul>
@endsection

