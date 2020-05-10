<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTimeOffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_time_off', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('time_off_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('notes');
            $table->longText('file');
            $table->enum('status_request',['pending','approved','reject']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_time_off');
    }
}
