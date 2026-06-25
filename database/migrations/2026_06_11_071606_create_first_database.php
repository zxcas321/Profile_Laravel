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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('bio');
            $table->string('photo_url');
            $table->string('phone');
            $table->string('location');
            $table->string('github_url');
            $table->string('linkedin_url');
            $table->string('website_url');
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('skill');
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('github_url');
            $table->string('thumbnail_url');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('project_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained("projects")->onDelete('cascade');
            $table->foreignId('skill_id')->constrained("skills")->onDelete('cascade');
            $table->timestamps();
            $table->unique(['project_id', 'skill_id']);
        });

        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('institution');
            $table->string('degree');
            $table->string('field')->nullable();
            $table->date('started_at');
            $table->date('ended_at');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('experiences', function(Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('company');
            $table->string('position');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_skills');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('educations');
    }
};
