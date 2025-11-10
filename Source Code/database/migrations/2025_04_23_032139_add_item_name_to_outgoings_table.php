<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outgoings', function (Blueprint $table) {
            $table->string('item_name')->after('id');
        });
    }

    public function down()
    {
        Schema::table('outgoings', function (Blueprint $table) {
            $table->dropColumn('item_name');
        });
    }

};
