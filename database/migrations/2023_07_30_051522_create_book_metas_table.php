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
        Schema::create('book_metas', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("book_id");
            $table->boolean("is_returned")->default(false);
            $table->date("issued_at");
            $table->date("returned_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_metas');
    }
};
