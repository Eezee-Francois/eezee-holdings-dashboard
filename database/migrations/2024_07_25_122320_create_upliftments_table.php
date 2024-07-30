<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('upliftments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('consultant_id');
            $table->string('consultant_name');
            $table->integer('client_id');
            $table->string('client_name');
            $table->string('company_name');
            $table->integer('truck_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('appointment_day_id')->nullable();
            $table->string('completed');
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('province');
            $table->text('address');
            $table->text('address_comments')->nullable();
            $table->text('lat');
            $table->text('lng');
            $table->text('telephone_1');
            $table->text('telephone_2')->nullable();
            $table->string('size');
            $table->string('billing_month')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upliftments');
    }
};
