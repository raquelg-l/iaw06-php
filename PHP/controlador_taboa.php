<?php
// Link to the file that has the connection function
include_once ('PHP/conexion_bd.php');
// Link to the file that has the CRUD functions
include_once ('PHP/funcions-crud.php');

// Run the code inside
try {
    // If there's an ISBN present in the url
    if (isset($_GET['isbn'])) {
        // Store the ISBN value in this variable
        $isbn_delete = $_GET['isbn'];

        // Deletion function
        $delete_book = deletebook($isbn_delete);
    }

    // Obtain genres for the navbar function
    $resultnavbar = getgenrenames();

    // Obtain books for the table function
    $resultable = getallbooks();

// Catch anything that failed in the try block
} catch (Exception $e) {
    // Show what failed
    return "Erro na conexión: " . $e->getMessage();
}
?>