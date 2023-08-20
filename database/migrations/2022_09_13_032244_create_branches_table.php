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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->foreignId('shop_type_id')->constrained('shop_types')->onDelete('restrict');
            $table->string('name')->unique();
            $table->string('name_mm');
            $table->string('slug')->unique();
            $table->string('phone_number');
            $table->boolean('is_main_branch')->default(false);
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict');
            $table->foreignId('township_id')->constrained('townships')->onDelete('restrict');
            $table->string('logo_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('website_url')->nullable();
            $table->string('facebook_page')->nullable();
            $table->string('address');
            $table->longText('description');
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
        Schema::dropIfExists('branches');
    }
};
