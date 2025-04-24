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
    <!-- Barra de navegación -->
    <nav class="navbar">
        <!-- Logo -->
        <div class="logo"><img src="ASSETS/logo.svg" alt="Logo" width="150"></div>
        
        <!-- Hamburger Menu -->
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="hamburger">
            <i class="fas fa-bars"></i>
        </label>

        <!-- Zona de busca -->
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Título, autor, xénero...">
            <i class="fas fa-search search-icon"></i>
        </div>
    </nav>

    <div class="titulo-taboa">
        <h1>Lista de libros</h1>
        <button class="add-button">
    <i class="fas fa-plus"></i> <span>Engadir novo</span>
</button>
    </div>

    <table class="taboa mobile-optimised">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Xénero</th>
                <th scope="col">Stock</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-th="ID">1</td>
                <td data-th="Título">Tomie</td>
                <td data-th="Autor">Junji Ito</td>
                <td data-th="Xénero">Horror</td>
                <td data-th="Stock">15</td>
            </tr>
            <tr>
                <td data-th="ID">2</td>
                <td data-th="Título">La hija del clérigo</td>
                <td data-th="Autor">George Orwell</td>
                <td data-th="Xénero">Ficción</td>
                <td data-th="Stock">30</td>
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