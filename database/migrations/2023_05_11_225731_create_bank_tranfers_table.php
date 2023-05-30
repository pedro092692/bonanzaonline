<?php

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
        Schema::create('bank_tranfers', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->integer('reference');
            $table->string('image');
            $table->integer('order_id')->unsigned()->zerofill();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });

        // DB::statement('ALTER TABLEbank_tranfers CHANGE order_id order_id INT(6) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_tranfers');
    }
};
