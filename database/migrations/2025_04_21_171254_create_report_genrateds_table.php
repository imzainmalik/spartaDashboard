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
        Schema::create('report_genrateds', function (Blueprint $table) {
            $table->id();
            $table->string('assessment_no');
            $table->integer('is_report_generated')->default(0)->comment('0=no, 1=yes');
            $table->string('report_file');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_genrateds');
    }
};
