<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('src')->default('folder');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('folders')->onDelete('cascade');
            $table->integer('position')->default(0);
            $table->boolean('protected')->default(false);
            $table->boolean('is_trash')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Создаем начальные папки
        $folders = [
            [
                'name' => 'Общая',
                'slug' => 'common',
                'src' => 'folder',
                'protected' => true,
                'is_trash' => false,
            ],
            [
                'name' => 'Видео',
                'slug' => 'video',
                'src' => 'video',
                'protected' => true,
                'is_trash' => false,
            ],
            [
                'name' => 'Документы',
                'slug' => 'document',
                'src' => 'document',
                'protected' => true,
                'is_trash' => false,
            ],
            [
                'name' => 'Корзина',
                'slug' => 'basket',
                'src' => 'basket',
                'protected' => true,
                'is_trash' => true,
            ],
        ];
        
        foreach ($folders as $folderData) {
            DB::table('folders')->insert($folderData);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};

