<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->foreignId('id')->primary()->constrained('posts')->onDelete('cascade');
            $table->date('start_date')->default(now());
            $table->time('start_time')->default(now());
            $table->date('end_date')->nullable();
            $table->time('end_time')->default();
            $table->string('link')->nullable();
            $table->string('location')->nullable();
            $table->string('organisateur')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
