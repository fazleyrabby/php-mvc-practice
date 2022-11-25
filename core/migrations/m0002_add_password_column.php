<?php

use App\Core\App;

class m0002_add_password_column{
    public function up()
    {
        $db = App::$app->db;
        $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = App::$app->db;
        $sql = "ALTER TABLE users DROP COLUMN password;";
        $db->pdo->exec($sql);
    }
}