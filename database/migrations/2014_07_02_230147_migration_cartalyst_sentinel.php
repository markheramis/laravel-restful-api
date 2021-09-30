<?php

/*
 * Part of the Sentinel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Sentinel
 * @version    4.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2020, Cartalyst LLC
 * @link       https://cartalyst.com
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationCartalystSentinel extends Migration
{

    private function __create_activations_table(): void
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('code', 100);
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    private function __create_persistences_table(): void
    {
        Schema::create('persistences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('code', 100);
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->unique('code');
        });
    }

    private function __create_reminders_table(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('code');
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    private function __create_roles_table(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
            $table->text('permissions')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->unique('slug');
        });
    }

    private function __create_role_users_table(): void
    {
        Schema::create('role_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->nullableTimestamps();
            $table->engine = 'InnoDB';
        });
    }

    private function __create_throttle_table(): void
    {
        Schema::create('throttle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('type');
            $table->string('ip')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index('user_id');
        });
    }

    private function __create_users_table(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->unique('email');
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->__create_activations_table();
        $this->__create_persistences_table();
        $this->__create_reminders_table();
        $this->__create_roles_table();
        $this->__create_role_users_table();
        $this->__create_throttle_table();
        $this->__create_users_table();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activations');
        Schema::drop('persistences');
        Schema::drop('reminders');
        Schema::drop('roles');
        Schema::drop('role_users');
        Schema::drop('throttle');
        Schema::drop('users');
    }
}
