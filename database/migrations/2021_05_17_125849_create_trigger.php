<?php

use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
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

        // PostgreSQL code
        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            // Create function for trigger
            $trigger_function_statement = "CREATE OR REPLACE FUNCTION trigger_function()
                                            RETURNS TRIGGER 
                                            LANGUAGE PLPGSQL
                                            AS
                                            $$
                                            BEGIN
                                                call make_order(NEW.quantity, NEW.item_id);
                                            END;
                                            $$;";
            DB::statement($trigger_function_statement);

            // Create trigger
            $trigger_statement = "CREATE TRIGGER items_insert
                                    AFTER INSERT
                                    ON items
                                    EXECUTE PROCEDURE trigger_function();";
            DB::statement($trigger_statement);
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
            $statement = "DROP TRIGGER Items_INSERT";
            DB::statement($statement);
        }

        // PostgreSQL code
        if (DB::connection() instanceof \Illuminate\Database\PostgresConnection) {
            $statement = "DROP TRIGGER items_insert;";
            DB::statement($statement);
        }
    }
}
