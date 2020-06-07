<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsBookstorehistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookstorehistories', function (Blueprint $table) {
            $table->string('name',100)->after('bookstore_id');
            $table->string('region',10)->after('name');
            $table->string('pref',10)->after('region');
            $table->string('address')->after('pref');
            $table->string('image_path')->nullable()->after('address');
            $table->integer('user_id')->after('image_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookstorehistories', function (Blueprint $table) {
          $table->dropColumn(['name','region','pref','address','image_path','user_id']);
    
        });
        }
}
