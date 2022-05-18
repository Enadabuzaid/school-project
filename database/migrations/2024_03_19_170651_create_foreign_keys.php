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

        Schema::table('my_parents', function(Blueprint $table) {
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type_bloods');
            $table->foreign('Religion_Father_id')->references('id')->on('religions');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type_bloods');
            $table->foreign('Religion_Mother_id')->references('id')->on('religions');
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
