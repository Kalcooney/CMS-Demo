<?php

require_once('db_credentials.php');

// Connect to MySQL database
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
}


// Disconnect from database
function db_disconnect($connection) {
    if (isset($connection)) { mysqli_close($connection); }
}

// Confirm database is connected. If not, produce an error message
function confirm_db_connect() {
    if(mysqli_connect_errno()) {
        $msg = "Database Connection Failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (".mysqli_connect_errno().")";
        exit($msg);
    }
}

// Confirm whether the database query was successful
function confirm_result_set($result_set) {
    if(!$result_set) {
        exit("Database query failed.");
    }
}

?>