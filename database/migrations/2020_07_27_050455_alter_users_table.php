<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('roles')->nullable();
            $table->text('address')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('api_token')->nullable();
            $table->enum('status',['ACTIVE','INACTIVE'])->default('ACTIVE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn("roles");
            $table->dropColumn("address");
            $table->dropColumn("city_id");
            $table->dropColumn("province_id");
            $table->dropColumn("phone");
            $table->dropColumn("avatar");
            $table->dropColumn("api_token");
            $table->dropColumn("status");
        });
    }
}
