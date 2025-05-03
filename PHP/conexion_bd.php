<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<?php

// This function connects the user to the database
function connect_to_db() {
    // Database credentials
    $host = "localhost";
    $user = "root";
    $pwd = "abc123.";
    $db = "raquel_gonzalez_bd";

    // Connect to the database using the credentials above
    $connection = mysqli_connect($host, $user, $pwd, $db);

    // If the connection doesn't happen
    if (!$connection) {
        // Stop the script and show this
        die("Error na conexión: " . mysqli_connect_error());
    }

    // If the function works, give back the connection so it can be used elsewhere
    return $connection;
}

// Function to close the connection to the database
function close_connection($connection) {
    mysqli_close($connection);
}
?>