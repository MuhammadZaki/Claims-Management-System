<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */

    /**
     * Run the migrations.
     * @table admin
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('password', 100);
            $table->enum('type', ['HIA','hospital', 'clinic', 'laboratory', 'pharmacy', 'radiology'])->default('hospital');
            $table->string('credit')->default(0);
            $table->string('avatar')->nullable()->default(null);
            $table->timestamps();
            $table->rememberToken();
        });

        \DB::table('admins')->insert([
            'id'        => '1',
            'name'      => 'Egyptian Insurance',
            'email'     => 'admin@admin.com',
            'type'     => 'HIA',
            'password'  => \Hash::make('123456789')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('admins');
     }
}
