<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateI18nTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i18n_translations', function (Blueprint $table) {
            $table->unsignedInteger('source_id');
            $table->string('language');
            $table->string('message');
            $table->primary(['source_id', 'language']);
            $table->foreign('language')->references('code')->on('languages');
            $table->foreign('source_id')->references('id')->on('i18n_sources')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i18n_translations');
    }
}
