<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ================================
        // 1. FK pada outgoings
        // ================================
        Schema::table('outgoings', function (Blueprint $table) {
            if (!Schema::hasColumn('outgoings', 'item_id')) {
                $table->unsignedBigInteger('item_id')->nullable()->after('id');
            }
        });

        // Tambah FK hanya jika belum ada
        $exists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'outgoings' 
              AND COLUMN_NAME = 'item_id'
        ");

        if (empty($exists)) {
            Schema::table('outgoings', function (Blueprint $table) {
                $table->foreign('item_id')
                      ->references('id')->on('items')
                      ->onDelete('set null');
            });
        }

        // ================================
        // 2. item_id pada products
        // ================================
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'item_id')) {
                $table->unsignedBigInteger('item_id')->nullable()->after('category_id');
            }
        });

        $exists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'products' 
              AND COLUMN_NAME = 'item_id'
        ");

        if (empty($exists)) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreign('item_id')
                      ->references('id')->on('items')
                      ->onDelete('set null');
            });
        }

        // ================================
        // 3. order_product (pivot)
        // ================================

        // FK untuk order_id
        $existsOrder = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'order_product' 
              AND COLUMN_NAME = 'order_id'
        ");

        if (empty($existsOrder)) {
            Schema::table('order_product', function (Blueprint $table) {
                $table->foreign('order_id')
                      ->references('id')->on('orders')
                      ->onDelete('cascade');
            });
        }

        // FK untuk product_id
        $existsProduct = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'order_product' 
              AND COLUMN_NAME = 'product_id'
        ");

        if (empty($existsProduct)) {
            Schema::table('order_product', function (Blueprint $table) {
                $table->foreign('product_id')
                      ->references('id')->on('products')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::table('outgoings', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
        });

        Schema::table('order_product', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['product_id']);
        });
    }
};
