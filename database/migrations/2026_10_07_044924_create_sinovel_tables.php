<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom profil ke tabel users bawaan
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');
            $table->date('birth_date')->nullable();
            $table->string('gender', 10)->nullable();
            $table->text('bio')->nullable();
            $table->string('website')->nullable();
            $table->string('avatar_url')->nullable();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('genre_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained()->cascadeOnDelete();
            $table->primary(['user_id', 'genre_id']);
        });

        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('cover')->nullable();
            $table->text('synopsis');
            $table->string('status')->default('Semua Umur • Bersambung');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->decimal('rating', 2, 1)->default(0);
            $table->timestamps();
        });

        Schema::create('genre_novel', function (Blueprint $table) {
            $table->foreignId('novel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained()->cascadeOnDelete();
            $table->primary(['novel_id', 'genre_id']);
        });

        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novel_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('number');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
            $table->unique(['novel_id', 'number']);
        });

        Schema::create('reading_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->boolean('is_private')->default(true);
            $table->timestamps();
        });

        Schema::create('novel_reading_list', function (Blueprint $table) {
            $table->foreignId('reading_list_id')->constrained()->cascadeOnDelete();
            $table->foreignId('novel_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->primary(['reading_list_id', 'novel_id']);
        });

        Schema::create('reading_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('novel_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('current_chapter')->default(0);
            $table->boolean('is_finished')->default(false);
            $table->timestamps();
            $table->unique(['user_id', 'novel_id']);
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('novel_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // selesai, tambah_koleksi, lanjut_baca, rating
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
        Schema::dropIfExists('reading_progress');
        Schema::dropIfExists('novel_reading_list');
        Schema::dropIfExists('reading_lists');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('genre_novel');
        Schema::dropIfExists('novels');
        Schema::dropIfExists('genre_user');
        Schema::dropIfExists('genres');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'birth_date', 'gender', 'bio', 'website', 'avatar_url']);
        });
    }
};