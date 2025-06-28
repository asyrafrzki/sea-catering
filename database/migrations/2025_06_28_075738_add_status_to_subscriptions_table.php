<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->string('status')->default('active')->after('total_price');
    });
}


    /**
     * Reverse the migrations.
     */
  public function down()
{
    Schema::table('subscriptions', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
