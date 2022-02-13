<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('Grades', function(Blueprint $table) {
			$table->increments('id');
			$table->string('grade_name', 255);
			$table->longText('notes');
            $table->string('created_by',100);
            $table->timestamps();

        });
	}

	public function down()
	{
		Schema::drop('Grades');
	}
}
