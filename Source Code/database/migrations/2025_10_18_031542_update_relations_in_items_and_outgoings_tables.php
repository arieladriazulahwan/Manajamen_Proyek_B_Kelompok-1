<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tambahkan kolom incoming_id di tabel items (jika belum ada)
        Schema::table('items', function (Blueprint $table) {
            if (!Schema::hasColumn('items', 'incoming_id')) {
                $table->foreignId('incoming_id')
                    ->nullable()
                    ->constrained('incomings')
                    ->onDelete('set null');
            }
        });

        // Tambahkan kolom item_id di tabel outgoings (jika belum ada)
        Schema::table('outgoings', function (Blueprint $table) {
            if (!Schema::hasColumn('outgoings', 'item_id')) {
                $table->foreignId('item_id')
                    ->nullable()
                    ->constrained('items')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'incoming_id')) {
                $table->dropForeign(['incoming_id']);
                $table->dropColumn('incoming_id');
            }
        });

        Schema::table('outgoings', function (Blueprint $table) {
            if (Schema::hasColumn('outgoings', 'item_id')) {
                $table->dropForeign(['item_id']);
                $table->dropColumn('item_id');
            }
        });
    }
};
