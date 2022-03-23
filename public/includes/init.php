<?php

use System\Databases\Database;
require_once "settings.php";
require_once Database::class;
require_once "classes/Databases/Database.php";
require_once "classes/Orders/Order.php";
require_once "classes/Products/Product.php";
require_once "classes/Reservations/Reservation.php";
require_once "classes/Users/User.php";

try {
    //New DB connection
    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection = $db->getConnection();
} catch (Exception $e) {
    //Set error variable for template
    $error = "Oops, try to fix your error please: " .
        $e->getMessage() . " on line " . $e->getLine() . " of " .
        $e->getFile();
}