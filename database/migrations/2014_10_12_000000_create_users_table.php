<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->boolean("is_online")->default(0);
            $table->string("department")->default("FRO")->comment("AND for android and FRO for front-end and BAC for back-end");
            $table->string("utype")->default("USR")->comment("SADM for super admin and ADM for admin and USR for user or developer");
            $table->boolean("is_active")->default(0);
            $table->boolean('is_admin')->default(0);
            $table->timestamp("last_activity")->default(now());
            $table->string("created_by")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
