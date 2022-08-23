<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->fulltext();
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'TRASHED'])->default('DRAFT');
            $table->timestamps();

            $table->unique(['website_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
