@extends('layouts.store-manager_layout')

<h1>Order {{ $order->id }}</h1>

<p>Customer Name: {{ $order->customer_name }}</p>
<p>Order Date: {{ $order->order_date }}</p>
<p>Total: {{ $order->total }}</p>
<p>Status: {{ $order->status }}</p>

<h2>Products:</h2>

<ul>
    @foreach ($order->products as $product)
        <li>{{ $product->name }} ({{ $product->pivot->quantity }})</li>
    @endforeach
</ul>

@endsection
