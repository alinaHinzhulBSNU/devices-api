<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statement = "CREATE FUNCTION getSum(@quantity INT, @device_id INT)
                        RETURNS FLOAT
                        AS
                        BEGIN
                            DECLARE @price FLOAT, @discount FLOAT, @sum FLOAT
                            SET @price = (select price from devices where id = @device_id)
                            SET @discount = (select discount from devices where id = @device_id)
                            SET @sum = @price * @quantity * (1 - @discount/100)
                            RETURN @sum
                        END";

        DB::statement($statement);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $statement = "DROP FUNCTION getSum";
        DB::statement($statement);
    }
}
