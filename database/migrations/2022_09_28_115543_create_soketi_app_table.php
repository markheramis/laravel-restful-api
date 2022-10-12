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
        Schema::create('soketi_app', function (Blueprint $table) {
            $table->id();
            $table->string('key', 255);
            $table->string('secret', 255);
            $table->integer('max_connections')->length(10);
            $table->boolean('enable_client_messages')->length(1);
            $table->boolean('enabled');
            $table->integer('max_backend_events_per_sec')->length(10);
            $table->integer('max_client_events_per_sec')->length(10);
            $table->integer('max_read_req_per_sec')->length(10);
            $table->text('webhooks');
            $table->boolean('max_presence_members_per_channel')->nullable();
            $table->boolean('max_presence_member_size_in_kb')->nullable();
            $table->boolean('max_channel_name_length')->nullable();
            $table->boolean('max_event_channels_at_once')->nullable();
            $table->boolean('max_event_name_length')->nullable();
            $table->boolean('max_event_payload_in_kb')->nullable();
            $table->boolean('max_event_batch_size')->nullablee();
            $table->boolean('enable_user_authentication')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soketi_app');
    }
};

/*
CREATE TABLE IF NOT EXISTS `apps` (
    `id` varchar(255) NOT NULL,
    `key` varchar(255) NOT NULL,
    `secret` varchar(255) NOT NULL,
    `max_connections` integer(10) NOT NULL,
    `enable_client_messages` tinyint(1) NOT NULL,
    `enabled` tinyint(1) NOT NULL,
    `max_backend_events_per_sec` integer(10) NOT NULL,
    `max_client_events_per_sec` integer(10) NOT NULL,
    `max_read_req_per_sec` integer(10) NOT NULL,
    `webhooks` json,
    `max_presence_members_per_channel` tinyint(1) NULL,
    `max_presence_member_size_in_kb` tinyint(1) NULL,
    `max_channel_name_length` tinyint(1) NULL,
    `max_event_channels_at_once` tinyint(1) NULL,
    `max_event_name_length` tinyint(1) NULL,
    `max_event_payload_in_kb` tinyint(1) NULL,
    `max_event_batch_size` tinyint(1) NULL,
    `enable_user_authentication` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
);

*/
