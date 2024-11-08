<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loan_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->date('loan_date');
            $table->date('return_date')->nullable();
            $table->enum('status', ['sedang dipinjam', 'dikembalikan'])->default('sedang dipinjam');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_history');
    }
};
