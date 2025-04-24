<!DOCTYPE html>
<html lang="gl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Libros & co.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo"><img src="ASSETS/logo.svg" alt="Logo" width="150"></div>
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Título, autor, xénero...">
            <i class="fas fa-search search-icon"></i>
        </div>
    </nav>

    <div class="titulo-taboa">
        <h1>Lista de libros</h1>
        <button class="add-button">
            <i class="fas fa-plus"></i> Engadir novo
        </button>
    </div>

    <table>
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Xénero</th>
                <th>Stock</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox"></td>
                <td>1</td>
                <td>Tomie</td>
                <td>Junji Ito</td>
                <td>Horror</td>
                <td>15</td>
                <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>2</td>
                <td>La hija del clérigo</td>
                <td>George Orwell</td>
                <td>Ficción</td>
                <td>30</td>
                <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
        </tbody>
    </table>

    <footer>
        <div class="footer-content">
            <span>© 2025 Raquel G-L para IAW06</span>
            <div class="icons">
                <i class="fab fa-github"></i>
                <i class="fas fa-envelope"></i>
            </div>
        </div>
    </footer>
</body>

</html>