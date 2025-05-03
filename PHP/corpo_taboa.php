<!-- Table body -->
<tbody>
    <?php
    // Loop through each row in the result set from the table query
    while ($row = mysqli_fetch_array($resultable, MYSQLI_ASSOC)) {
        echo "<tr>";
        // Display the ISBN in its table cell
        echo '<td data-th="ISBN">' . $row['isbn'] . '</td>';
        // Display the title in its table cell
        echo '<td data-th="Título">' . $row['titulo'] . '</td>';
        // Display the author in its table cell
        echo '<td data-th="Autor">' . $row['autor'] . '</td>';
        // Display the genre name in its table cell
        echo '<td data-th="Xénero">' . $row['nome'] . '</td>';
        // Display the stock in its table cell
        echo '<td data-th="Stock">' . $row['stock'] . '</td>';
        // Kebab menu
        echo '<td class="td-end">
                        <div class="dropdown">
                            <!-- Button that triggers the dropdown menu -->
                            <button class="btn btn-kebab" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Kebab icon -->
                                <i class="fas fa-ellipsis-v"></i>
                            </button>

                            <!-- Dropdown with the actions -->
                            <ul class="dropdown-menu kebab-dropdown" aria-labelledby="dropdownMenuButton">
                                <!-- Option to update the book (passes ISBN in the URL) -->
                                <li><a class="dropdown-item" href="formulario.php?isbn=' . $row['isbn'] . '">Actualizar</a></li>

                                <!-- Option to delete the book (passes ISBN in the URL) -->
                                <li><a class="dropdown-item text-danger" href="lista-libros.php?isbn=' . $row['isbn'] . '">Eliminar</a></li>

                            </ul>
                        </div>
                        </td>';
        // End the table row
        echo "</tr>";
    }
    ?>
</tbody>