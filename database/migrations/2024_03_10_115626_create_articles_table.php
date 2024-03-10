<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title');
            $table->string('slug')->unique()->nullable();
            $table->string('featuring_image')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('star')->default(0);
            $table->enum('status' , \App\Models\Panel\Article::$status)
                ->default(\App\Models\Panel\Article::STATUS_PENDING);
            $table->unsignedBigInteger('view_count')->default(0);
            $table->longText('content')->nullable();
            $table->longText('image');
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
