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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('original_name');
            $table->string('extension', 5);
            $table->string('disk')->default('upload');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('type')->default('photo'); // photo, video, document, audio
            $table->unsignedBigInteger('size'); // размер в байтах
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->foreign('folder_id')
                ->references('id')
                ->on('folders')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedBigInteger('original_folder_id')->nullable();
            $table->foreign('original_folder_id')
                ->references('id')
                ->on('folders')
                ->onDelete('set null');
            $table->string('telegram_file_id')->nullable();
            $table->json('metadata')->nullable();
            $table->boolean('temporary')->default(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

