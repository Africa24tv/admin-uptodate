<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
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
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('resume')->nullable();
            $table->foreignId('subject_id')->nullable()->constrained()->onDelete('cascade'); #sogner a retier le nullable

            $table->boolean('is_video')->default(false);

            $table->enum('status', ['brouillon', 'envoyé', 'publié'])->nullable()->default('brouillon');

            $table->boolean('private')->nullable()->default(false);

            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();

            $table->boolean('is_public_published')->nullable()->default(false);
            $table->foreignId('validator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->softDeletes();
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
}
