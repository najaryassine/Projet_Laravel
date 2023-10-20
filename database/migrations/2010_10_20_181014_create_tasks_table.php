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
        // Désactiver la vérification des contraintes de clé étrangère
        Schema::disableForeignKeyConstraints();

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->enum('status', ['not completed','in progress', 'completed'])->default('not completed');
            $table->timestamps();
        });

        // Réactiver la vérification des contraintes de clé étrangère
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Désactiver la vérification des contraintes de clé étrangère
        Schema::disableForeignKeyConstraints();

        // Supprimer la contrainte de clé étrangère et la table
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['assigned_to']);
        });
        Schema::dropIfExists('tasks');

        // Réactiver la vérification des contraintes de clé étrangère
        Schema::enableForeignKeyConstraints();
    }
};
