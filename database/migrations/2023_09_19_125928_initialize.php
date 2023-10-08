<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('nohp')->nullable();
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 64)->default('user');
            $table->foreignId('organisasi_id')
                ->nullable()
                ->constrained('organisasi')->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->string('key', 64)->nullable();
            $table->morphs('model');
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('organisasi_id')->nullable()
                ->constrained('organisasi')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create('pemohon', function (Blueprint $table) {
            $table->id();
            $table->string('nohp')->nullable();
            $table->string('alamat')->nullable();
            $table->json('data')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique('user_id');
            $table->timestamps();
        });
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->nullable()->unique();
            $table->foreignId('pemohon_id')->constrained('pemohon')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('jenis_pemohon', 64)->default('perorangan');
            $table->string('status')->default('konsep');
            $table->text('permohonan')->nullable();
            $table->text('informasi')->nullable();
            $table->json('data')->nullable();
            $table->foreignId('organisasi_id')->nullable()
                ->constrained('organisasi')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('permohonan_puas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('puas');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
        Schema::create('permohonan_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('status');
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->timestamp('waktu');
        });
    }

    public function down(): void
    {
        throw new Error("Tidak bisa di rollback.");
    }
};
