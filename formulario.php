<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<!DOCTYPE html>
<html lang="gl">

<head>
  <!-- Base metadata -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Page title -->
  <title>Engadir novo libro</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="estilo.css" />
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
</head>

<body class="bg-white">
  <!-- Navigation bar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-black rounded-pill px-3 py-2 my-3">
    <!-- Logo -->
    <a class="navbar-brand ms-3" href="#">
      <img src="ASSETS/logo.svg" alt="Logo" width="150" />
    </a>

    <!-- Phone view hamburger button -->
    <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Menú">
      <i class="fas fa-bars"></i>
      <i class="fas fa-times d-none"></i>
    </button>

    <!-- Phone view responsive menu -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <!-- Genres dropdown -->
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <!-- Title -->
          <a class="nav-link dropdown-toggle text-white" href="lista-libros.php" role="button" data-bs-toggle="dropdown">
            Xéneros
          </a>
          <!-- Options -->
          <ul class="dropdown-menu dropdown-menu-end">
            <!-- Option 1 -->
            <li><a class="dropdown-item" href="lista-libros.php?genero=ciencia-ficcion">Ciencia ficción</a></li>
            <!-- Option 2 -->
            <li><a class="dropdown-item" href="lista-libros.php?genero=accion">Acción</a></li>
            <!-- Option 3 -->
            <li><a class="dropdown-item" href="lista-libros.php?genero=drama">Drama</a></li>
          </ul>
        </li>
      </ul>
      <!-- Search area -->
      <form class="d-flex position-relative my-2 my-md-0">
        <!-- Search form -->
        <input class="form-control border-0 rounded-pill ps-4 pe-5 search-desktop-md" type="search" placeholder="Título, autor, xénero..." aria-label="Buscar" />
        <!-- Magnifying glass icon -->
        <span class="position-absolute end-0 top-50 translate-middle-y me-3 text-black">
          <i class="fas fa-search"></i>
        </span>
      </form>
    </div>
  </nav>

  <!-- Form container -->
  <div class="container d-flex align-items-center justify-content-center p-0">
    <!-- Card -->
    <div class="card shadow-sm border-0 w-100 form-add-book-bg" style="max-width: 950px; border-radius: 1.5rem;">
      <div class="row g-0">
        <!-- Left column -->
        <div class="col-md-5 d-flex flex-column align-items-center justify-content-center py-md-4">
          <!-- Book animated illustration -->
          <img src="ASSETS/novo-libro.gif" alt="Novo Libro" class="img-fluid illustration-phone">
        </div>

        <!-- Right column -->
        <div class="col-md-7">
          <!-- Card -->
          <div class="card-body p-3 p-md-4">
            <!-- Title -->
            <h1 class="fw-normal mb-4">Engadir novo libro</h1>
            <br>
            <!-- Form -->
            <form>
              <!-- Title -->
              <div class="mb-4">
                <!-- Label -->
                <label for="titulo" class="form-label fw-normal" style="color: #8E8E93">Título</label>
                <!-- Zona de contestación -->
                <input type="text" class="form-control rounded-pill" id="titulo" placeholder="Introduce o título" required>
              </div>
              <!-- Autor -->
              <div class="mb-4">
                <!-- Label -->
                <label for="autor" class="form-label fw-normal" style="color: #8E8E93">Autor</label>
                <!-- Answer area -->
                <input type="text" class="form-control rounded-pill" id="autor" placeholder="Introduce o autor" required>
              </div>
              <!-- Genre -->
              <div class="mb-4">
                <!-- Label -->
                <label for="xenero" class="form-label fw-normal" style="color: #8E8E93">Xénero</label>
                <!-- Genre selection dropdown -->
                <select id="xenero" class="form-select rounded-pill" required>
                  <!-- Dropdown title -->
                  <option value="" disabled selected>Selecciona un xénero</option>
                  <!-- Option 1 -->
                  <option value="horror">Horror</option>
                  <!-- Option 2 -->
                  <option value="ficcion">Ficción</option>
                  <!-- Option 3 -->
                  <option value="ciencia-ficcion">Ciencia ficción</option>
                  <!-- Option 4 -->
                  <option value="accion">Acción</option>
                  <!-- Option 5 -->
                  <option value="drama">Drama</option>
                </select>
              </div>
              <!-- Stock -->
              <div class="mb-5">
                <!-- Label -->
                <label for="stock" class="form-label fw-normal" style="color: #8E8E93">Stock</label>
                <!-- Number selection -->
                <input type="number" class="form-control rounded-pill" id="stock" placeholder="Ex. 10" min="0" required>
              </div>
              <!-- Buttons -->
              <div class="form-actions mt-3">
                <!-- Add -->
                <button type="submit" class="btn btn-info text-white rounded-pill px-4">Engadir</button>
                <!-- Cancel -->
                <a href="lista-libros.php" class="btn btn-outline-info rounded-pill px-4 hover-outline" style="color: #32ADE6;" onclick="document.location='lista-libros.php'">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-black text-white fixed-bottom py-3">
    <div class="d-flex justify-content-between align-items-center" style="margin: 0 5%;">
      <!-- Left text -->
      <span>© 2025 Raquel G-L para IAW06</span>
      <!-- Icons -->
      <div class="d-flex gap-3">
        <!-- Github icon -->
        <a href="#" class="text-white"><i class="fab fa-github"></i></a>
        <!-- Mail icon -->
        <a href="#" class="text-white"><i class="fas fa-envelope"></i></a>
      </div>
    </div>
  </footer>

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!--Hamburger to X toggle in phone view -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggler = document.querySelector('.navbar-toggler');
      const iconHamburger = toggler.querySelector('.fa-bars');
      const iconClose = toggler.querySelector('.fa-times');
      const navbarCollapse = document.getElementById('navbarContent');

      navbarCollapse.addEventListener('show.bs.collapse', function() {
        iconHamburger.classList.add('d-none');
        iconClose.classList.remove('d-none');
      });

      navbarCollapse.addEventListener('hide.bs.collapse', function() {
        iconHamburger.classList.remove('d-none');
        iconClose.classList.add('d-none');
      });
    });
  </script>
</body>

</html>