<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statement = "CREATE TRIGGER Items_INSERT
                        ON items AFTER INSERT
                        AS
                        BEGIN
                            DECLARE @quantity INT, @id INT, @result INT
                        
                            SET @quantity = (select quantity from inserted)
                            SET @id = (select item_id from inserted)
                        
                            exec MakeOrder @quantity, @id, @result output
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
        $statement = "DROP TRIGGER Items_INSERT";
        DB::statement($statement);
    }
}
