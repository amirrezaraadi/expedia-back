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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title') ;
            $table->string('slug')->nullable()->unique();
            $table->enum('advertising' , \App\Models\Panel\Ads::$advertising);
            $table->enum('type_advertising' , \App\Models\Panel\Ads::$typees);
            $table->timestamp("expire_at")->nullable();
            $table->enum('opening_limit' , \App\Models\Panel\Ads::$opening_limit );
            $table->string('image')->nullable() ;
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->softDeletes() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
