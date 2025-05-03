<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('region');
            $table->string('age');
            $table->string('gendar');
            $table->string('role');
            $table->string('photo')->nullable();  
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

            DB::table('users')->insert(
                [['name' => 'admin', 'email' => 'admin@gmail.com','password'=>Hash::make('admin@gmail.com'),'phone'=>'1234567890','region'=>'cairo','age'=>'40','gendar'=>'male','role'=>'admin','photo'=>'77.jpg'],
                ['name' => 'Colleen Hoover', 'email' => 'ColleenHoover@gmail.com','password'=>Hash::make('ColleenHoover@gmail.com'),'phone'=>'1234567890','region'=>'cairo','age'=>'40','gendar'=>'female','role'=>'author','photo'=>'44707F76-1.jpg'],
                ['name' => 'Stephen king', 'email' => 'stephenking@gmail.com','password'=>Hash::make('stephenking@gmail.com'),'phone'=>'1234567890','region'=>'cairo','age'=>'40','gendar'=>'male','role'=>'author','photo'=>'stephen-king.by-shane-leonard_wide-f9df986f26c8d66ecb63cf8e49bded6360cbd9d3.jpg'],
                ['name' => 'Ta-Nehisi Coates', 'email' => 'Ta-NehisiCoates@gmail.com','password'=>Hash::make('Ta-NehisiCoates@gmail.com'),'phone'=>'1234567890','region'=>'cairo','age'=>'40','gendar'=>'male','role'=>'author','photo'=>'GettyImages-1496820780_yjgi3a.jpg'],
                ['name' => 'CELESTE NG', 'email' => 'CELESTENG@gmail.com','password'=>Hash::make('CELESTENG@gmail.com'),'phone'=>'1234567890','region'=>'cairo','age'=>'40','gendar'=>'female','role'=>'author','photo'=>'21CELESTENG2-videoSixteenByNine3000.jpg'],
                ['name' => 'ابن خلدون ', 'email' => 'benkhaldone@gmail.com','password'=>Hash::make('benkhaldone@gmail.com'),'phone'=>'1234567890','region'=>'cairo','age'=>'40','gendar'=>'male','role'=>'author','photo'=>'images.jpg'],
                ['name' => 'user one', 'email' => 'userone@gmail.com','password'=>Hash::make('userone@gmail.com'),'phone'=>'1234567890','region'=>'cairo','age'=>'40','gendar'=>'male','role'=>'user','photo'=>'77.jpg'],
   
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
