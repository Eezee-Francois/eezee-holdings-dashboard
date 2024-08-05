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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('goods_received_note_id')->nullable();
            $table->integer('supplier_invoice_id')->nullable();
            $table->integer('final_invoice_id')->nullable();
            $table->integer('consultant_id');
            $table->string('consultant_name');
            $table->integer('client_id');
            $table->string('client_name');
            $table->string('company_name');
            $table->string('supplier_account_code');
            $table->string('weight');
            $table->decimal('price', 8, 2);
            $table->string('province');
            $table->text('address');
            $table->text('signature');
            $table->string('stock_code');
            $table->string('completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
