<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabase extends Command
{
    protected $signature = 'db:create';
    protected $description = 'Create the database if it does not exist';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dbName = env('DB_DATABASE');

        try {
            // Verify if the database exists
            $result = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'");

            if (count($result) == 0) {
                // If the database does not exist, create it
                $this->info("Database '$dbName' not found. Creating the database...");
                DB::statement("CREATE DATABASE $dbName");
                $this->info("Database '$dbName' created successfully!");
            } else {
                $this->info("Database '$dbName' already exists.");
            }
        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }
    }
}
