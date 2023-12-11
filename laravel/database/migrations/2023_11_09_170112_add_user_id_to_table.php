<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Type\VoidType;
use Symfony\Component\HttpFoundation\RequestMatcher\SchemeRequestMatcher;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('codeBlocks', function (Blueprint $table) {
            $table->string('shareToken')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

    }
};
