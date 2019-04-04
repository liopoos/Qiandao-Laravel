<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template', function (Blueprint $table) {
            $table->bigIncrements('tid');
            $table->integer('uid');
            $table->string('name', 255);
            $table->string('description', 255);
            $table->text('har_content');
            $table->text('request_url');
            $table->text('request_method');
            $table->text('post_type');
            $table->text('header_replace');
            $table->text('query_replace');
            $table->text('post_replace');
            $table->enum('response_type', ['1', '2']);
            $table->text('response_replace');
            $table->text('success_response');
            $table->enum('relation', ['1', '2', '3']);
            $table->integer('used_number');
            $table->integer('is_publish')->default(0);
            $table->integer('is_valid')->default(1);
            $table->integer('is_delete')->default(0);
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
        Schema::dropIfExists('template');
    }
}
