<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('address')->unique();
            $table->string('username')->nullable();
            $table->string('balance');
            $table->unsignedInteger('total_votes');
            $table->unsignedInteger('produced_blocks')->nullable();
            $table->unsignedInteger('rank')->nullable();
            $table->string('voting_for_address')->nullable();
            $table->string('voting_for_username')->nullable();
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
        Schema::dropIfExists('wallets');
    }
}
