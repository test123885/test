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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('checkout_id');
            $table->unsignedBigInteger('book_id');
            $table->string('statuse');   
            $table->integer('quantaty');
            $table->foreign('user_id') 
            ->references('id')
            ->on('users')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreign('author_id') 
            ->references('id')
            ->on('users')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreign('checkout_id') 
            ->references('id')
            ->on('checkouts')
            ->constrained()
            ->cascadeOnDelete();
            $table->foreign('book_id') 
            ->references('id')
            ->on('books')
            ->constrained()
            ->cascadeOnDelete();
            $table->timestamps();
        });

        DB::table('orders')->insert(
            [
            ['user_id' => '7','author_id'=>'2','checkout_id'=>'1','book_id'=>'3','statuse'=>'deleverd','quantaty'=>'7'],
            ['user_id' => '7','author_id'=>'2','checkout_id'=>'1','book_id'=>'9','statuse'=>'deleverd ','quantaty'=>'3'],
            ['user_id' => '7','author_id'=>'2','checkout_id'=>'1','book_id'=>'13','statuse'=>'deleverd','quantaty'=>'8'],
            ['user_id' => '7','author_id'=>'2','checkout_id'=>'2','book_id'=>'4','statuse'=>'deleverd','quantaty'=>'4'],
            ['user_id' => '7','author_id'=>'2','checkout_id'=>'2','book_id'=>'19','statuse'=>'deleverd ','quantaty'=>'5'],
            ['user_id' => '7','author_id'=>'3','checkout_id'=>'2','book_id'=>'21','statuse'=>'deleverd','quantaty'=>'6'],
            ['user_id' => '7','author_id'=>'3','checkout_id'=>'2','book_id'=>'22','statuse'=>'deleverd','quantaty'=>'4'],
            ['user_id' => '7','author_id'=>'2','checkout_id'=>'2','book_id'=>'1','statuse'=>'deleverd','quantaty'=>'4'],
            ['user_id' => '7','author_id'=>'5','checkout_id'=>'2','book_id'=>'49','statuse'=>'deleverd','quantaty'=>'4'],
            ['user_id' => '7','author_id'=>'5','checkout_id'=>'2','book_id'=>'50','statuse'=>'deleverd','quantaty'=>'10'],
            ['user_id' => '7','author_id'=>'3','checkout_id'=>'2','book_id'=>'25','statuse'=>'deleverd','quantaty'=>'4'],
            ['user_id' => '7','author_id'=>'4','checkout_id'=>'2','book_id'=>'74','statuse'=>'deleverd','quantaty'=>'4'],
            ['user_id' => '7','author_id'=>'6','checkout_id'=>'2','book_id'=>'88','statuse'=>'deleverd','quantaty'=>'4'],
            ['user_id' => '7','author_id'=>'6','checkout_id'=>'2','book_id'=>'90','statuse'=>'deleverd','quantaty'=>'4'],

            ]
 );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
