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
        Schema::table('public_fotos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->after('path');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('public_fotos', function (Blueprint $table) {
            //
            $table->dropForeign('public_fotos_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
