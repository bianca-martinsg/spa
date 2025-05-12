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
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

        // Create a temporary connection to the database
        config([
            'database.connections.temp' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => null,
                'username' => env('DB_USERNAME', 'root'),
                'password' => env('DB_PASSWORD', ''),
                'charset' => $charset,
                'collation' => $collation,
            ]
        ]);

        try {
            $schemaName = collect(\DB::connection('temp')
                ->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$dbName]))->first();

            if (!$schemaName) {
                \DB::connection('temp')->statement("CREATE DATABASE `$dbName` CHARACTER SET $charset COLLATE $collation");
                $this->info("Database '$dbName' created successfully!");
            } else {
                $this->info("Database '$dbName' already exists.");
            }
        } catch (\Exception $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }
    }

}


