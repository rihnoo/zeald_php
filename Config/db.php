<?php

final class Database
{
    private static $db = null;

    public static function Instance()
    {
        if (is_null(self::$db)) {
            self::$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }
        return self::$db;
    }
}
