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
        Schema::create('crawler_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('screenshot')->nullable();
            $table->text('title')->nullable();
            $table->text('url')->nullable();
            $table->text('description')->nullable();
            $table->longText('body')->nullable();
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
        Schema::dropIfExists('crawler_records');
    }
};
