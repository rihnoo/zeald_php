<?php

final class Database
{
    private static $db = null;

    public static function Instance()
    {
        if (is_null(self::$db)) {
            self::$db = new mysqli('localhost', 'root', '', 'nba2019');
        }
        return self::$db;
    }
}
