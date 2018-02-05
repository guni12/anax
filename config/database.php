<?php
/**
 * Config file for Database.
 *
 * Example for SQLite.
 *  "dsn" => "sqlite:memory::",
 *
 */

/*
return [
        "dsn"             => "mysql:host=localhost;dbname=test;",
        "username"        => "",
        "password"        => "",
        "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
        "fetch_mode"      => \PDO::FETCH_OBJ,
        "table_prefix"    => null,
        "session_key"     => "",
        // True to be very verbose during development
        "verbose"         => null,

        // True to be verbose on connection failed
        "debug_connect"   => false,
];
*/
$list = [];

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $list = [
        "dsn"             => "mysql:host=localhost;port=3336;dbname=anaxdb;",
        "username"        => "anax",
        "password"        => "anax",
        "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
        "fetch_mode"      => \PDO::FETCH_OBJ,
        "table_prefix"    => null,
        "session_key"     => "Anax\Database",
        // True to be very verbose during development
        "verbose"         => null,

        // True to be verbose on connection failed
        "debug_connect"   => false,
    ];
} else {
    $list = [
        "dsn"             => "mysql:host=blu-ray.student.bth.se;port=3306;dbname=guni12;",
        "username"        => "guni12",
        "password"        => "9aqxPFFYtDf4",
        "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
        "fetch_mode"      => \PDO::FETCH_OBJ,
        "table_prefix"    => null,
        "session_key"     => "Anax\Database",
        // True to be very verbose during development
        "verbose"         => null,

        // True to be verbose on connection failed
        "debug_connect"   => false,
    ];
}

return $list;
