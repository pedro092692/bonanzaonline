<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('contact');

            $table->string('phone');

            $table->enum('status', [Order::PENDING, Order::RECEIVED, Order::SHIPPED, Order::DELIVERED, Order::NULLED, Order::REVIEWING])->default(Order::PENDING);

            $table->enum('shipping_type', [1, 2]);

            $table->float('shipping_cost');

            $table->float('total');

            $table->json('content');

            // $table->unsignedBigInteger('department_id')->nullable();
            // $table->foreign('department_id')->references('id')->on('departments');
        
            // $table->unsignedBigInteger('city_id')->nullable();
            // $table->foreign('city_id')->references('id')->on('cities');

            // $table->unsignedBigInteger('district_id')->nullable();
            // $table->foreign('district_id')->references('id')->on('districts');

            // $table->string('address')->nullable();
            
            // $table->string('references')->nullable();

            $table->json('shipping')->nullable();

            $table->timestamps();
        });

        DB::statement('ALTER TABLE orders CHANGE id id INT(6) UNSIGNED ZEROFILL NOT NULL auto_increment');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
