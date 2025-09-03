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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->integer('page_count');
//            //update for to unpublish for later (now do it for temporary)
//            $table->enum('status', ['published', 'processing' , 'unpublished'])->default('published');
            $table->string('publisher');
            $table->enum('language', ['kh', 'en'])->default('kh');
            $table->date('published_at')->nullable();//publish date
            $table->string('cover')->nullable();
            $table->string('pdf_url')->nullable();
            $table->string('flip_link')->nullable();
            $table->integer('view')->default(0);
            $table->boolean('is_available')->default(false);
            $table->string('author')->nullable();
            $table->string('code', 10)->unique();
            $table->string('isbn', 13)->unique();
//            $table->json('tags')->nullable();//must cast to array in model class
            $table->enum('type', ['physical', 'ebook'])->default('physical');
            $table->tinyInteger('downloadable')->default(0);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories')->nullOnDelete();
            $table->foreignId('shelf_id')->nullable()->constrained('shelves')->nullOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->nullOnDelete();
            $table->foreignId('grade_id')->nullable()->constrained('grades')->nullOnDelete();
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
