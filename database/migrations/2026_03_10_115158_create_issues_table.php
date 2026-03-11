<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issue_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('provider');
            $table->string('target_repository_or_project');
            $table->string('title');
            $table->text('body');
            $table->string('status')->default('open');
            $table->timestamps();
        });

        Schema::create('issue_submission_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_submission_id')
                  ->constrained('issue_submissions')
                  ->onDelete('cascade');
            $table->string('meta_key');
            $table->text('meta_value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issue_submission_meta');
        Schema::dropIfExists('issue_submissions');
    }
};