<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . 'EntryBase.php';

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateArticlesTable extends EntryBase
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected function setColumns(Blueprint $table)
    {
        $table->integer('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->string('description', 255)->nullable();
        $table->boolean('enable_comments')->default(true);
        $table->boolean('show_on_main')->default(true);
        $table->string('cover')->nullable();
        $table->smallInteger('rank')->default(0);
        $table->integer('catalogue_id');
        $table->foreign('catalogue_id')->references('id')->on('catalogues');
    }


    protected function getTableName(): string
    {
        return 'articles';
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
