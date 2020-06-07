<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHanddleNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commenthistories', function (Blueprint $table) {
            $table->string('handdle_name')->after('comment_id');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commenthistories', function (Blueprint $table) {
          $table->dropColumn(['handdle_name']);
        });
    }
}
