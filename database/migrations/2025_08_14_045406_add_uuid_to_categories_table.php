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
        Schema::table('categories', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->unique();
        });

        $categories = \App\Models\Category::all();
        foreach ($categories as $category) {
            $category->update(['uuid' => \Illuminate\Support\Str::uuid()]);
        }

        Schema::table('categories', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
