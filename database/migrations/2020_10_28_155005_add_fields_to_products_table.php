<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->string('name',100);
            $table->Text('description');
            $table->string('image');
            $table->decimal('price', 8, 2);
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('name',);
            $table->dropColumn('description');
            $table->dropColumn('image');
            $table->dropColumn('price',);
            $table->dropColumn('type');
        });
    }
}
