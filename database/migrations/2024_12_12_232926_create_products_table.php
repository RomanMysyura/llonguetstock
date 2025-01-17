<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('quantity');
        $table->unsignedBigInteger('category_id')->nullable(); // <--- Aquí lo hacemos nullable
        $table->timestamps();
    
        // Definimos la foreign key
        $table->foreign('category_id')
              ->references('id')
              ->on('categories')
              ->onDelete('cascade');
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
