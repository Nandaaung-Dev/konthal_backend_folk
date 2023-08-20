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
        Schema::create('provider_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict');
            $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade');
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
        Schema::dropIfExists('provider_branches');
    }
};
