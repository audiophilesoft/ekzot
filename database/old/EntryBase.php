<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

abstract class EntryBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTableName(), function (Blueprint $table) {
            $this->setColumns($table);

            $table->increments('id');
            $table->string('title', 128)->unique();
            $table->string('url', 128)->unique();
            $table->text('content');
            $table->text('images')->nullable();
            $table->text('files')->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->string('meta_tags', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('views_count')->unsigned()->default(0);
            $table->timestampsTz();
        });
    }

    abstract protected function setColumns(Blueprint $table);

    abstract protected function getTableName(): string;

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTableName());
    }
}
