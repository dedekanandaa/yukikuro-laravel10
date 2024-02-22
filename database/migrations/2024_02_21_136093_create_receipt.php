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
        Schema::create('receipt', function (Blueprint $table) {
            $table->foreignId('id_product')->constrained('product');
            $table->foreignId('id_transaction')->constrained('transaction');
            $table->tinyInteger('qty');
            $table->enum('payment', ['done', 'cancel', 'deny']);
            $table->timestamps();
            
            $table->primary(['id_product', 'id_transaction']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt');
    }
};
