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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('profition')->nullable();
            $table->string('province_bith')->nullable();
            $table->string('neighborhood')->nullable();
            $table->enum('marital_status', ['solteiro', 'casado', 'divorciado', 'viuvo', 'uniao_factos']);
            $table->date('date_marriag')->nullable();
            $table->enum('baptized', ['y', 'n'])->nullable();
            $table->enum('marriag_church', ['y', 'n'])->nullable();
            $table->text('church_name_marriag')->nullable();
            $table->date('date_baptism')->nullable();
            $table->enum('batizad_from_marriag', ['y', 'n'])->nullable();
            $table->enum('has_position_church', ['y', 'n']);
            $table->text('position')->nullable();
            $table->date('date_joined');
            $table->text('notes')->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
