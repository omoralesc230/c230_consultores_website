<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('motivation_letter')->nullable();
            $table->string('curriculum')->nullable();
            $table->string('source')->nullable();
            $table->string('situation')->nullable();
            $table->string('university')->nullable();
            $table->decimal('grade_average', 3, 2)->nullable();
            $table->mediumText('topics')->nullable();
            $table->mediumText('stata')->nullable();
            $table->mediumText('plans')->nullable();
            $table->integer('mexican')->nullable();
            $table->mediumText('reason_to_work')->nullable();
            $table->mediumText('reason_to_hire')->nullable();
            $table->mediumText('comments')->nullable();
            $table->integer('vacancy_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
