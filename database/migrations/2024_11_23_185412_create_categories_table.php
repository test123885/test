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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('catname');
            $table->timestamps();
        });
        DB::table('categories')->insert(
            [['catname' => 'english books'],
            ['catname' => 'arabik books'],
            ['catname' => 'kids books'],
            ['catname' => 'engineering books'],
            ['catname' => 'sports books'],
            ['catname' => 'history books'],
            ['catname' => 'arts books'],
            ['catname' => 'fation books'],
            ['catname' => 'ai and datascience'],
            ['catname' => 'software engineering'],
            
            
            
            ]
 );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
