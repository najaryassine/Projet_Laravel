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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id'); // Foreign key to link to articles
            $table->unsignedBigInteger('client_id')->nullable(); // Foreign key for clients (nullable)
            $table->unsignedBigInteger('freelancer_id')->nullable(); // Foreign key for freelancers (nullable)
            $table->text('body');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('freelancer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
