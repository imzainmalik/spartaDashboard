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
        Schema::create('assement_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('assement_fillup_id');
            $table->text('perimeter_security_comment');
            $table->text('perimeter_entry_point_comment');
            $table->text('perimeter_lighting_comment');
            $table->integer('risk_scoring');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assement_comments');
    }
};
