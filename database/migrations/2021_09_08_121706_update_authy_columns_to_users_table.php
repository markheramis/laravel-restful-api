<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAuthyColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country_code')->after('password')->nullable();
            $table->string('phone_number')->after('country_code')->nullable();
            $table->string('authy_id')->after('phone_number')->nullable();
            $table->boolean('authy_enabled')->default(false)->after('authy_id')->nullable();
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
            $table->dropColumn('country_code');
            $table->dropColumn('phone_number');
            $table->dropColumn('authy_id');
            $table->dropColumn('authy_enabled');
        });
    }
}
