<?php
// Link to the file that has the connection function
include_once ('conexion_bd.php');
// Variable that save the connection to the database
$connection = connect_to_db();

// Link to the file that has the CRUD functions
include_once ('funcions-crud.php');

// Run the code inside
try {
    // Variables to store the info of the book that is going to be updated
    $isbn_update = "";
    $title_update = "";
    $author_update = "";
    $genre_update = "";
    $stock_update = "";

    // If there's an ISBN present in the url
    if (isset($_GET['isbn'])) {
        // Store the ISBN value in this variable
        $isbn_update = $_GET['isbn'];

        // Retrieve the info of the book that is going to be updated function
        $booktoupdate = getbook($isbn_update);

        // If there's at least one result and one row on the result
        if ($booktoupdate && mysqli_num_rows($booktoupdate) > 0) {
            // Make the result an associative array and store it in the variable
            $booktoupdate_info = mysqli_fetch_assoc($booktoupdate);
            // Making the associative array's values more accesible
            $title_update = $booktoupdate_info['titulo'];
            $author_update = $booktoupdate_info['autor'];
            $genre_update = $booktoupdate_info['nome'];
            $stock_update = $booktoupdate_info['stock'];
        }
    }

    // Process the form only if it was submitted via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Rename the form items to something more manageable and avoid potential SQL inyections
        $isbn = mysqli_real_escape_string($connection, $_POST['isbn']);
        $title = mysqli_real_escape_string($connection, $_POST['titulo']);
        $author = mysqli_real_escape_string($connection, $_POST['autor']);
        $genre_name = mysqli_real_escape_string($connection, $_POST['xenero']);
        $stock = intval($_POST['stock']);

        // Get the genre id from its name function
        $result_genre = getgenreid($genre_name);

        // If there's at least 1 result
        if ($result_genre && mysqli_num_rows($result_genre) > 0) {
            // Obtain genre id
            $row_genre = mysqli_fetch_assoc($result_genre);
            $genre_id = $row_genre['id'];

            // If isbn_update is not empty
            if (!empty($_POST['isbn_update'])) {
                // Update the book function
                updatebook($isbn, $title, $author, $genre_id, $stock, $_POST['isbn_update']);

            // If isbn_update is empty and the user is adding a new book
            } else {
                // Insert new book function
                addbook($isbn, $title, $author, $genre_id, $stock);
            }
        // If there's no result
        } else {
            // Show this
            return "Xénero non atopado.";
        }
    }

    // Obtain genres for the navbar function
    $resultnavbar = getgenrenames();
    // Obtain genres for the form function
    $resultform = getgenrenames();

// Catch anything that failed in the try block
} catch (Exception $e) {
    // Show what failed
    return "Error de conexión: " . $e->getMessage();
}
?>