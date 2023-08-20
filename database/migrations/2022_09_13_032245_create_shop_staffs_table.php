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
        Schema::create('shop_staffs', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->unique();
            $table->string('profile_photo')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->dateTime('activation_date')->nullable();
            $table->dateTime('status_change_date')->nullable();
            $table->nullableMorphs('status_changable');
            $table->string('address');
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->foreignId('shop_department_id')->constrained('shop_departments')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict');
            $table->foreignId('township_id')->constrained('townships')->onDelete('restrict');
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
        Schema::dropIfExists('shop_staffs');
    }
};
