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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('stat');
            $table->string('city');
            $table->string('streetnumber'); 
            $table->string('method');   
            $table->string('booktype');   
            $table->text('notes')->nullable();
            $table->timestamps();
        });
        DB::table('checkouts')->insert(
            [
            ['name' => 'user one','email'=>'userone@gmail.com','phone'=>'1234567890','stat'=>'cairo','city'=>'new cairo','streetnumber'=>'streetnumber one','method'=>'cash','booktype'=>'pdf'],
            ['name' => 'user two','email'=>'usertwo@gmail.com','phone'=>'1234567890','stat'=>'giza','city'=>'new giza ','streetnumber'=>'streetnumber two','method'=>'cash','booktype'=>'pdf'],
            ['name' => 'user three','email'=>'userthree@gmail.com','phone'=>'1234567890','stat'=>'cairo','city'=>'naser city','streetnumber'=>'streetnumber three','method'=>'cash','booktype'=>'pdf with paper']
            ]
 );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
