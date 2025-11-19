<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('orders', function (Blueprint $table) {
        if (!Schema::hasColumn('orders', 'customer_name')) {
            $table->string('customer_name')->after('id');
        }
        if (!Schema::hasColumn('orders', 'total_price')) {
            $table->decimal('total_price', 12, 2)->default(0)->after('customer_name');
        }
        if (!Schema::hasColumn('orders', 'status')) {
            $table->string('status')->default('pending')->after('total_price');
        }
    });
}


    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'status', 'total_price']);
        });
    }
};
