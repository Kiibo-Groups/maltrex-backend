<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',50);
            $table->integer('school_id');
            $table->integer('manager_id');
            $table->longtext('concepts');
            $table->string('unidad',150);
            $table->integer('cantidad');
            $table->double('precio_unit',11);
            $table->double('iva',11);
            $table->double('total',11);
            $table->integer('status');
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
        Schema::dropIfExists('assignments');
    }
};
