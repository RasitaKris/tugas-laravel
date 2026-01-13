<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    // ⬇️ dibuat nullable
    $table->string('shipping_name')->nullable();
    $table->string('shipping_phone')->nullable();
    $table->text('shipping_address')->nullable();

    $table->string('shipping_service')->nullable();
    $table->integer('shipping_cost')->nullable();

    $table->string('payment_method');
    $table->string('payment_channel');

    $table->integer('total');
    $table->string('status')->default('pending');

    $table->timestamps();
});

}


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
