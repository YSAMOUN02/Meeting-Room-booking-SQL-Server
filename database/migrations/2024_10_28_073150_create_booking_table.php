<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Panol;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {

        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('room')->nullable();
            $table->string('room_id')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('department')->nullable();
            $table->text('title')->nullable();
            $table->string('meeting_type')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('created_by_id')->nullable();
            $table->string('created_by_name')->nullable();
            $table->string('cancel_by_name')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->date('cancel_date')->nullable();
            $table->string('status')->default(1);
            $table->integer('alerted')->default(0);
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
        Schema::dropIfExists('booking');
    }
};
