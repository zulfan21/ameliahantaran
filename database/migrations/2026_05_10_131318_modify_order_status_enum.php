<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'pending',
                'waiting_payment',
                'payment_verification',
                'diproses',
                'cancel_request',
                'dikirim',
                'selesai',
                'dibatalkan'
            )
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'pending',
                'waiting_payment',
                'payment_verification',
                'diproses',
                'dikirim',
                'selesai',
                'dibatalkan'
            )
        ");
    }
};
