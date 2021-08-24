<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressAvataBirthGenderToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avata','255')->nullable();
            $table->date('birth_day','255')->nullable();
            $table->string('address','500')->nullable();
            $table->integer('phone_number');
            $table->enum('gender',['male','female','unisex']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avata');
            $table->dropColumn('birth_day');
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
        });
    }
}
