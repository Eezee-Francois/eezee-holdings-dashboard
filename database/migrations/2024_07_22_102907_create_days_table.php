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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('driver_id');
            $table->integer('term_id');
            $table->date('date');

            $table->string('five')->default('OPEN');
            $table->time('five_time')->default('05:00');
            $table->integer('five_appointment_id')->nullable();
            $table->text('five_appointment_information')->nullable();

            $table->string('five_thirty')->default('OPEN');
            $table->time('five_thirty_time')->default('05:30');
            $table->integer('five_thirty_appointment_id')->nullable();
            $table->text('five_thirty_appointment_information')->nullable();

            $table->string('six')->default('OPEN');
            $table->time('six_time')->default('06:00');
            $table->integer('six_appointment_id')->nullable();
            $table->text('six_appointment_information')->nullable();

            $table->string('six_thirty')->default('OPEN');
            $table->time('six_thirty_time')->default('06:30');
            $table->integer('six_thirty_appointment_id')->nullable();
            $table->text('six_thirty_appointment_information')->nullable();
            
            $table->string('seven')->default('OPEN');
            $table->time('seven_time')->default('07:00');
            $table->integer('seven_appointment_id')->nullable();
            $table->text('seven_appointment_information')->nullable();
            
            $table->string('seven_thirty')->default('OPEN');
            $table->time('seven_thirty_time')->default('07:30');
            $table->integer('seven_thirty_appointment_id')->nullable();
            $table->text('seven_thirty_appointment_information')->nullable();

            $table->string('eight')->default('OPEN');
            $table->time('eight_time')->default('08:00');
            $table->integer('eight_appointment_id')->nullable();
            $table->text('eight_appointment_information')->nullable();

            $table->string('eight_thirty')->default('OPEN');
            $table->time('eight_thirty_time')->default('08:30');
            $table->integer('eight_thirty_appointment_id')->nullable();
            $table->text('eight_thirty_appointment_information')->nullable();

            $table->string('nine')->default('OPEN');
            $table->time('nine_time')->default('09:00');
            $table->integer('nine_appointment_id')->nullable();
            $table->text('nine_appointment_information')->nullable();

            $table->string('nine_thirty')->default('OPEN');
            $table->time('nine_thirty_time')->default('09:30');
            $table->integer('nine_thirty_appointment_id')->nullable();
            $table->text('nine_thirty_appointment_information')->nullable();

            $table->string('ten')->default('OPEN');
            $table->time('ten_time')->default('10:00');
            $table->integer('ten_appointment_id')->nullable();
            $table->text('ten_appointment_information')->nullable();

            $table->string('ten_thirty')->default('OPEN');
            $table->time('ten_thirty_time')->default('10:30');
            $table->integer('ten_thirty_appointment_id')->nullable();
            $table->text('ten_thirty_appointment_information')->nullable();

            $table->string('eleven')->default('OPEN');
            $table->time('eleven_time')->default('11:00');
            $table->integer('eleven_appointment_id')->nullable();
            $table->text('eleven_appointment_information')->nullable();

            $table->string('eleven_thirty')->default('OPEN');
            $table->time('eleven_thirty_time')->default('11:30');
            $table->integer('eleven_thirty_appointment_id')->nullable();
            $table->text('eleven_thirty_appointment_information')->nullable();

            $table->string('twelvepm')->default('OPEN');
            $table->time('twelvepm_time')->default('12:00');
            $table->integer('twelvepm_appointment_id')->nullable();
            $table->text('twelvepm_appointment_information')->nullable();

            $table->string('twelvepm_thirty')->default('OPEN');
            $table->time('twelvepm_thirty_time')->default('12:30');
            $table->integer('twelvepm_thirty_appointment_id')->nullable();
            $table->text('twelvepm_thirty_appointment_information')->nullable();

            $table->string('onepm')->default('OPEN');
            $table->time('onepm_time')->default('13:00');
            $table->integer('onepm_appointment_id')->nullable();
            $table->text('onepm_appointment_information')->nullable();

            $table->string('onepm_thirty')->default('OPEN');
            $table->time('onepm_thirty_time')->default('13:30');
            $table->integer('onepm_thirty_appointment_id')->nullable();
            $table->text('onepm_thirty_appointment_information')->nullable();

            $table->string('twopm')->default('OPEN');
            $table->time('twopm_time')->default('14:00');
            $table->integer('twopm_appointment_id')->nullable();
            $table->text('twopm_appointment_information')->nullable();

            $table->string('twopm_thirty')->default('OPEN');
            $table->time('twopm_thirty_time')->default('14:30');
            $table->integer('twopm_thirty_appointment_id')->nullable();
            $table->text('twopm_thirty_appointment_information')->nullable();

            $table->string('threepm')->default('OPEN');
            $table->time('threepm_time')->default('15:00');
            $table->integer('threepm_appointment_id')->nullable();
            $table->text('threepm_appointment_information')->nullable();

            $table->string('threepm_thirty')->default('OPEN');
            $table->time('threepm_thirty_time')->default('15:30');
            $table->integer('threepm_thirty_appointment_id')->nullable();
            $table->text('threepm_thirty_appointment_information')->nullable();

            $table->string('fourpm')->default('OPEN');
            $table->time('fourpm_time')->default('16:00');
            $table->integer('fourpm_appointment_id')->nullable();
            $table->text('fourpm_appointment_information')->nullable();

            $table->string('fourpm_thirty')->default('OPEN');
            $table->time('fourpm_thirty_time')->default('16:30');
            $table->integer('fourpm_thirty_appointment_id')->nullable();
            $table->text('fourpm_thirty_appointment_information')->nullable();

            $table->string('fivepm')->default('OPEN');
            $table->time('fivepm_time')->default('17:00');
            $table->integer('fivepm_appointment_id')->nullable();
            $table->text('fivepm_appointment_information')->nullable();

            $table->string('fivepm_thirty')->default('OPEN');
            $table->time('fivepm_thirty_time')->default('17:30');
            $table->integer('fivepm_thirty_appointment_id')->nullable();
            $table->text('fivepm_thirty_appointment_information')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
