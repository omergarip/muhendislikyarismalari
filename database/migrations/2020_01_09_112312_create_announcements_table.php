<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('organizer')->nullable();
            $table->string('title');
            $table->integer('user_id');
            $table->string('category_slug');
            $table->string('image');
            $table->text('description');
            $table->timestamp('deadline')->nullable();
            $table->text('reward')->nullable();
            $table->string('detail');
            $table->string('fbappid');
            $table->string('slug');
            $table->softDeletes();
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
        Schema::dropIfExists('announcements');
    }
}
