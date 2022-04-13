<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{

        Schema::table('classrooms', function(Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('Grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });


        Schema::table('sections', function (Blueprint $table){
           $table->foreign('class_id')->references('id')->on('classrooms')
                        ->onDelete('cascade');
        });

        Schema::table('sections', function (Blueprint $table){
            $table->foreign('grade_id')->references('id')->on('Grades')
                ->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->dropForeign('classrooms_Grades_id_foreign');
		});

        Schema::table('sections', function(Blueprint $table) {
            $table->dropForeign('sections_Grades_id_foreign');
        });

        Schema::table('sections', function(Blueprint $table) {
            $table->dropForeign('sections_classroom_id_foreign');
        });
	}
}
