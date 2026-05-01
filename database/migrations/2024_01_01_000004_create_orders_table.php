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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->text('notes')->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->decimal('shipping_cost', 15, 2)->default(0);
            $table->decimal('total', 15, 2);
            $table->enum('status', ['pending', 'waiting_payment', 'payment_verification', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'waiting_verification', 'paid', 'rejected'])->default('unpaid');
            $table->string('payment_method')->default('qris');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('tracking_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
