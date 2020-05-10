<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestOvertimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_overtime', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('request_date');
            $table->time('overtime_duration');
            $table->text('description');
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
        Schema::dropIfExists('request_overtime');
    }
}
