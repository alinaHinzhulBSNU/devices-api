<?php

use Illuminate\Database\Migrations\Migration;

class CreateFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // MS SQL Server code
        if (DB::connection() instanceof \Illuminate\Database\SqlServerConnection) {
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

        // PostgreSQL code
        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $statement = "create function get_sum(quantity int, device_id int)
                            returns real
                            language plpgsql
                            as
                            $$
                            declare
                                price real;
                                discount real;
                                sum real;
                            begin
                                select devices.price into price from devices where id = device_id;
                                select devices.discount into discount from devices where id = device_id;
                                sum := price * quantity * (1 - discount/100);
                                return sum;
                            end;
                            $$;";
            DB::statement($statement);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // MS SQL Server code
        if (DB::connection() instanceof \Illuminate\Database\SqlServerConnection) {
            $statement = "DROP FUNCTION getSum";
            DB::statement($statement);
        }

        // PostgreSQL code
        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $statement = "DROP FUNCTION get_sum;";
            DB::statement($statement);
        }
    }
}
