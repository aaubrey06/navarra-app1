<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('purchase_order_details', function (Blueprint $table) {
        //     $table->foreign('product_id')->references('product_id')->on('products');
        //     $table->foreign('po_status_id')->references('po_status_id')->on('purchase_order_status');
        //     $table->foreign('supplier_id')->references('supplier_id')->on('supplier');
        // });
        // Schema::table('order_details', function (Blueprint $table) {
        //     $table->foreign('product_id')->references('product_id')->on('products');
        //     $table->foreign('order_id')->references('order_id')->on('order');
        // });
        // Schema::table('delivery', function (Blueprint $table) {
        //     $table->foreign('driver_id')->references('driver_id')->on('driver');
        //     $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle');
        //     $table->foreign('order_id')->references('order_id')->on('order');
        //     $table->foreign('delivery_status_id')->references('delivery_status_id')->on('delivery_status');
        // });
        // Schema::table('order', function (Blueprint $table) {
        //     $table->foreign('customer_id')->references('customer_id')->on('customer');
        //     $table->foreign('order_status_id')->references('order_status_id')->on('order_status');
        // });
        // Schema::table('customer', function (Blueprint $table) {
        //     $table->foreign('id')->references('id')->on('users');
        // });
        // Schema::table('store_manager', function (Blueprint $table) {
        //     $table->foreign('id')->references('id')->on('users');
        //     $table->foreign('store_id')->references('store_id')->on('stores');
        // });
        Schema::table('warehouse_manager', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('warehouse_id')->references('warehouse_id')->on('warehouse');
        });
        Schema::table('warehouse_stocks', function (Blueprint $table) {
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('invtype_id')->references('invtype_id')->on('inventory_transaction_type');
            $table->foreign('warehouse_id')->references('warehouse_id')->on('warehouse');
        });
        // Schema::table('store_stocks', function (Blueprint $table) {
        //     $table->foreign('product_id')->references('product_id')->on('products');
        //     $table->foreign('invtype_id')->references('invtype_id')->on('inventory_transaction_type');
        //     $table->foreign('store_id')->references('store_id')->on('stores');
        // });


        // Schema::table('sales', function (Blueprint $table) {
        //     $table->foreign('product_id')->references('product_id')->on('products');
        // });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
