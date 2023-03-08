<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('operationDescription');
            $table->date('operationDate');
            $table->decimal('operationSomme', 15,2);
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->reference('id')
                ->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
