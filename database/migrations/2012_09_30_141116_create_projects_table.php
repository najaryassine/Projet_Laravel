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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('cost', 8, 2);
            $table->enum('status', ['not completed', 'completed'])->default('not completed');
            $table->text('required_skills'); 
            $table->string('category'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
