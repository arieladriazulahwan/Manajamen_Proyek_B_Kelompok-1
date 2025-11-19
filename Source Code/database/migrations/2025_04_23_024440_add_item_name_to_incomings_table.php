<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('incomings', function (Blueprint $table) {
            $table->string('item_name')->after('id')->nullable(); // tambahkan kolom
        });
    }

    public function down()
    {
        Schema::table('incomings', function (Blueprint $table) {
            $table->dropColumn('item_name'); // rollback
        });
    }
};
