<?php

namespace Database;

use App\Storage\DBStorage;

class Migration
{
    private DBStorage $db;

    public function __construct() {
        $this->db = new DBStorage;
    }

    public function run()
    {
        $files = glob(database_path() . "migrations/*");
        foreach($files as $file) {
            if(is_file($file)) {
                $sql = file_get_contents($file);
                $this->db->createTable($sql);

                printf(basename($file, ".sql") . " table created\n");
            }
        }
    }
}