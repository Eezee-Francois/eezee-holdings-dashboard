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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('consultant_id');
            $table->string('consultant_name');
            $table->string('company_name');
            $table->string('client_name');
            $table->text('telephone_1');
            $table->text('telephone_2')->nullable();
            $table->text('email')->nullable();
            $table->decimal('price', 8, 2);
            $table->text('client_comments')->nullable();
            $table->text('address');
            $table->text('lat');
            $table->text('lng');
            $table->text('address_comments')->nullable();
            $table->string('province');
            $table->string('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
