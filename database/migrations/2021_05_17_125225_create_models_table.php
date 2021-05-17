<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name')->unique('model_name');

            // Зовнішній ключ
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');

            // Складений індекс
            $table->index(['model_name', 'brand_id']);

            $table->text('description');
            $table->unsignedFloat('diagonal');
        });

        // Add the constraint
        $statment = "ALTER TABLE models ADD CONSTRAINT check_diagonal CHECK (diagonal > 0);";
        DB::statement($statment);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
}
