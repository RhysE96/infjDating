<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('name');
            $table->string('profile_image'); // Required profile image path/url

            $table->text('bio')->nullable();
            $table->date('birthdate');

            $table->string('location_name'); // e.g. "Manchester, UK"
            $table->decimal('latitude', 10, 8)->nullable(); // Geo API
            $table->decimal('longitude', 11, 8)->nullable();

            $table->enum('gender', ['male', 'female']);
            $table->json('looking_for_type'); // e.g. ["friendship", "relationship"]
            $table->json('looking_for_gender'); // e.g. ["male", "female"]

            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};