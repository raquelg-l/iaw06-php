<?php
// Reference to the php file that has the connection function
include_once('PHP/conexion_bd.php');



////////////////////////////// CREATE //////////////////////////////
// This function ads a book to the database
function addbook($isbn, $title, $author, $genre_id, $stock) {
    // Call to the function to connect to the database
    $connection = connect_to_db();

    // Variable with the name of the table that contains the books
    $tablebooks = "libros";

    // Query to insert the new book
    $sql_insert = "INSERT INTO $tablebooks (isbn, titulo, autor, xenero_id, stock) 
                   VALUES ('$isbn', '$title', '$author', $genre_id, $stock)";

    // If the insertion of the new book takes place
    if (mysqli_query($connection, $sql_insert)) {
        // Redirect to the main page with a confirmation
        header("Location: lista-libros.php?insert=ok");
        // Stop the script
        exit();
        // If the insertion of the new book doesn't take place
    } else {
        // Show this
        return "Error engadindo o libro.";
    }
    close_connection($connection);
}



////////////////////////////// READ //////////////////////////////
// This function gets all the books in the database
function getallbooks() {
    // Call to the function to connect to the database
    $connection = connect_to_db();

    // Variable with the name of the table that contains the books
    $tablebooks = "libros";
    // Variable with the name of the table that contains the genres
    $tablegenre = "xenero";

    // Query to retrieve all fields from libros and nome from xenero
    $selectbooks = "SELECT * FROM $tablebooks
                    JOIN $tablegenre ON $tablegenre.id = $tablebooks.xenero_id";
    // Execute the query for the table
    $resultallbooks = mysqli_query($connection, $selectbooks);

    // Call the function to close connection
    close_connection($connection);

    // Returns the result of the query to use it elsewhere
    return $resultallbooks;
}


// This function gets a specific book in the database
function getbook() {
    // Call to the function to connect to the database
    $connection = connect_to_db();

    // Variable with the name of the table that contains the books
    $tablebooks = "libros";
    // Variable with the name of the table that contains the genres
    $tablegenre = "xenero";
    // Store the ISBN value in this variable
    $isbn_update = $_GET['isbn'];

    // Query to retrieve the info of the book
    $selectbook = "SELECT $tablebooks.*, $tablegenre.nome
                   FROM $tablebooks 
                   JOIN $tablegenre ON $tablebooks.xenero_id = $tablegenre.id
                   WHERE isbn = '$isbn_update'";;
    // Execute the query for the table
    $resulbook = mysqli_query($connection, $selectbook);

    // Call the function to close connection
    close_connection($connection);

    // Returns the result of the query to use it elsewhere
    return $resulbook;
}


// This function gets all the genre names in the database
function getgenrenames() {
    // Call to the function to connect to the database
    $connection = connect_to_db();

    // Variable with the name of the table that contains the genres
    $tablegenre = "xenero";

    // Query to retrieve nome from xenero
    $selectname = "SELECT nome FROM $tablegenre";
    // Execute the query
    $resultgenrename = mysqli_query($connection, $selectname);

    // Call the function to close connection
    close_connection($connection);

    // Returns the result of the query to use it elsewhere
    return $resultgenrename;
}


// This function gets the genre id of a book in the database
function getgenreid($genre_name) {
    // Call to the function to connect to the database
    $connection = connect_to_db();

    // Variable with the name of the table that contains the genres
    $tablegenre = "xenero";

    // Query to retrieve nome from xenero
    $selectname = "SELECT id FROM $tablegenre WHERE nome = '$genre_name'";
    // Execute the query for the navbar
    $resultid = mysqli_query($connection, $selectname);

    // Call the function to close connection
    close_connection($connection);

    // Returns the result of the query to use it elsewhere
    return $resultid;
}



////////////////////////////// UPDATE //////////////////////////////
// This function updates a book
function updatebook($isbn, $title, $author, $genre_id, $stock, $original_isbn) {
    // Call to the function to connect to the database
    $connection = connect_to_db();

    // Variable with the name of the table that contains the books
    $tablebooks = "libros";

    // Query to update book
    $updatebook = "UPDATE $tablebooks 
                   SET isbn='$isbn', titulo='$title', autor='$author', xenero_id=$genre_id, stock=$stock
                   WHERE isbn='$original_isbn'";
    // If the update takes place
    if (mysqli_query($connection, $updatebook)) {
        // Redirect to the main page with a confirmation
        header("Location: lista-libros.php?update=ok");
        // Stop the script
        exit();
    // If the deletion query is not executed
    } else {
        // Show this
        return "Error actualizando o libro.";
    }
    // Call the function to close connection
     close_connection($connection);
}


////////////////////////////// DELETE //////////////////////////////
// This function deletes a book
function deletebook($isbn) {
    // Call to the function to connect to the database
    $connection = connect_to_db();

    // Deletion query
    $delete_book = "DELETE FROM libros WHERE isbn = '$isbn'";

    // If the deletion query is executed
    if (mysqli_query($connection, $delete_book)) {
        // Redirect the user to the regular index page with a confirmation
        header("Location: lista-libros.php?deletion=ok");
        // Stop the script
        exit();

        // If the deletion query is not executed
    } else {
        // Show this
        return "Error al eliminar el libro: " . mysqli_error($connection);
    }
}
?>