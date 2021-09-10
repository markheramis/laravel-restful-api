<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToOauthAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('client_id')->references('id')->on('oauth_clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_access_tokens', function (Blueprint $table) {
            $table->dropForeign('oauth_access_tokens_user_id_foreign');
            $table->dropForeign('oauth_access_tokens_client_id_foreign');
        });
    }
}
