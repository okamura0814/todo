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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content')->comment('内容');
            $table->date('due_date')->comment('期日');
            $table->tinyInteger('status');
            $table->integer('user_id');
            $table->timestamps();
        });
    }
};
