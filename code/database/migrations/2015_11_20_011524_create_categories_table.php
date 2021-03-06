<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->string('parent_id', 100)->nullable();
            $table->timestamps();
            $table->text('name', 100);
        });
    }

    public function down()
    {
        Schema::drop('categories');
    }
}
