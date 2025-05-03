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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('offer');
            $table->foreign('author_id') 
            ->references('id')
            ->on('users')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreign('book_id') 
            ->references('id')
            ->on('books')
            ->constrained()
            ->cascadeOnDelete();
            $table->timestamps();
        });


        DB::table('offers')->insert(
            [
                ['author_id' => '2','book_id' => '1','offer' => '1000.00'],
                ['author_id' => '2','book_id' => '5','offer' => '300.00'],
                ['author_id' => '3','book_id' => '25','offer' => '50.00'],
                ['author_id' => '4','book_id' => '77','offer' => '900.00'],
                ['author_id' => '4','book_id' => '80','offer' => '900.00'],
                ['author_id' => '6','book_id' => '86','offer' => '600.00'],
                ['author_id' => '6','book_id' => '88','offer' => '200.00'],
                ['author_id' => '6','book_id' => '90','offer' => '150.00'],
                ['author_id' => '5','book_id' => '51','offer' => '300.00'],
                ['author_id' => '5','book_id' => '55','offer' => '300.00'],
                ['author_id' => '5','book_id' => '60','offer' => '300.00'],
                ['author_id' => '4','book_id' => '62','offer' => '200.00'],
                ['author_id' => '3','book_id' => '28','offer' => '100.00'],
                ['author_id' => '2','book_id' => '13','offer' => '600.00'],
                ['author_id' => '2','book_id' => '15','offer' => '500.00'],
          
            
            
            
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
