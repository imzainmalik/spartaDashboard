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
        Schema::create('assement_fillups', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('customer_id');
            $table->integer('question_id');
            $table->integer('answer_id')->nullable();
            // $table->text('perimeter_security_comment');
            // $table->text('perimeter_entry_point_comment');
            // $table->text('perimeter_lighting_comment');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assement_fillups');
    }
};
