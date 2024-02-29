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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id('leave_applications_id');
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->nullable();
            $table->string('emp_id');
            $table->string('pdf_path')->nullable();
            $table->timestamps();

            $table->foreign('emp_id')
            ->references('emp_id')->on('employees')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_applications');
    }
};
