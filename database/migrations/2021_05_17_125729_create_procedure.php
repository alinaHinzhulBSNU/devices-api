<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcedure extends Migration
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
            $statement = "CREATE PROCEDURE MakeOrder @quantity INT, @item_id INT, @result INT OUTPUT
                            AS
                            DECLARE @device_id INT, @order_id INT, @total_quantity INT, @new_quantity INT, @sum FLOAT
                            BEGIN
                                SET @device_id = (SELECT d.id FROM items i inner join devices d on i.device_id = d.id WHERE i.id = @item_id)
                                SET @order_id = (SELECT order_id FROM items WHERE id = @item_id)
                                SET @total_quantity = (SELECT total_quantity FROM devices WHERE id = @device_id)
                                
                                IF @quantity <= @total_quantity
                                BEGIN
                                    BEGIN TRANSACTION
                                        SET @sum = dbo.getSum(@quantity, @device_id)
                                        SET @new_quantity = @total_quantity - @quantity
                                        UPDATE items SET total_sum = @sum WHERE id = @item_id
                                        UPDATE devices SET total_quantity = @new_quantity WHERE id = @device_id
                                        SET @result = 1
                                    COMMIT TRANSACTION
                                END
                                ELSE
                                BEGIN
                                    BEGIN TRANSACTION
                                        DELETE FROM orders WHERE id = @order_id
                                    COMMIT TRANSACTION
                                END
                            END";

            DB::statement($statement);
        }

        // PostgreSQL code
        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $statement = "create or replace procedure make_order(quantity int, i_id int)
                            language plpgsql    
                            as
                            $$
                            declare
                                device_id int; 
                                order_id int; 
                                total_quantity int; 
                                new_quantity int;
                                sum real;
                            begin
                                device_id := (SELECT d.id FROM items i inner join devices d on i.device_id = d.id WHERE i.id = i_id);
                                order_id := (SELECT order_id FROM items WHERE id = i_id);
                                total_quantity := (SELECT total_quantity FROM devices WHERE id = device_id);
                            
                                IF quantity <= total_quantity
                                THEN
                                    sum := get_sum(quantity, device_id);
                                    new_quantity := total_quantity - quantity;
                                    UPDATE items SET total_sum = sum WHERE id = i_id;
                                    UPDATE devices SET total_quantity = new_quantity WHERE id = device_id;
                                ELSE
                                    DELETE FROM orders WHERE id = order_id;
                                END IF;
                            end;$$";

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
            $statement = "DROP PROCEDURE MakeOrder";
            DB::statement($statement);
        }

        // PostgreSQL code
        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $statement = "DROP PROCEDURE make_order;";
            DB::statement($statement);
        }
    }
}
