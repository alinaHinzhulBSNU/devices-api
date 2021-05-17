<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statement = "CREATE PROCEDURE MakeOrder @quantity INT, @item_id INT, @result INT OUTPUT
                        AS
                        DECLARE @device_id INT, @order_id INT, @total_quantity INT, @new_quantity INT, @sum FLOAT
                        BEGIN
                            SET @device_id = (SELECT d.id FROM items i inner join devices d on i.device_id = d.id WHERE i.item_id = @item_id)
                            SET @order_id = (SELECT order_id FROM items WHERE item_id = @item_id)
                            SET @total_quantity = (SELECT total_quantity FROM devices WHERE id = @device_id)
                            
                            IF @quantity <= @total_quantity
                            BEGIN
                                BEGIN TRANSACTION
                                    SET @sum = dbo.getSum(@quantity, @device_id)
                                    SET @new_quantity = @total_quantity - @quantity
                                    UPDATE items SET total_sum = @sum WHERE item_id = @item_id
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $statement = "DROP PROCEDURE MakeOrder";
        DB::statement($statement);
    }
}
