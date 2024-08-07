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
            $table->string('category');
            $table->integer('purchase_order_id')->nullable();
            $table->integer('goods_received_note_id')->nullable();
            $table->integer('supplier_invoice_id')->nullable();
            $table->integer('final_invoice_id')->nullable();
            $table->integer('consultant_id');
            $table->string('consultant_name');
            $table->integer('client_id');
            $table->string('client_name');
            $table->string('company_name');
            $table->integer('truck_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('upliftment_day_id')->nullable();
            $table->string('completed');
            $table->string('stock_code');
            $table->string('type');
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
            $table->string('weight');
            $table->decimal('client_price', 8, 2);
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
