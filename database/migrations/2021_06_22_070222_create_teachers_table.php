<?php

use App\Models\Teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("admin_id")->nullable();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("phone")->unique();
            $table->string("designation");
            $table->string("password");
            $table->timestamps();
        });

        Teacher::create([
            'admin_id' => 1,
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'phone' => '01111111111',
            'designation' => 'teacher',
            'password' => Hash::make('teacher@gmail.com')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
