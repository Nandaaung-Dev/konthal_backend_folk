<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('name')->unique();
            $table->string('phone_number')->unique();
            $table->string('viber_number')->unique();
            $table->enum('status', ['Pending', 'Active', 'Inactive'])->default('Pending');
            $table->dateTime('activation_date')->nullable();
            $table->dateTime('status_change_date')->nullable();
            $table->nullableMorphs('status_changable');
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict');
            $table->foreignId('township_id')->constrained('townships')->onDelete('restrict');
            $table->string('profile_photo')->nullable();
            $table->string('nrc_number')->nullable();
            $table->string('nrc_front')->nullable();
            $table->string('nrc_back')->nullable();
            $table->string('address');
            $table->morphs('creatable');
            $table->nullableMorphs('updatable');
            $table->nullableMorphs('deletable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
};
