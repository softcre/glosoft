<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
      <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
      <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
    </ul>
    <!--end::Start Navbar Links-->
    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
      <!--begin::Fullscreen Toggle-->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
      </li>
      <!--end::Fullscreen Toggle-->
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" id="userMenuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?= $this->imagen->obtener_url($this->session->foto); ?>" class="user-image rounded-circle shadow" alt="User Image">
          <span class="d-none d-md-inline ms-2"><?= $_SESSION['apellido'] . ' ' . $_SESSION['nombre']; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="userMenuDropdown">
          <a href="<?= base_url(PERFIL_PATH . '/editarPerfil') ?>" class="dropdown-item">
            <i class="bi bi-person-fill me-2"></i> Mi Perfil
          </a>
          <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#large" data-url="<?= base_url(PERFIL_PATH . '/frmEditarContrasena') ?>">
            <i class="bi bi-key-fill me-2"></i> Cambiar contraseña
          </button>
          <div class="dropdown-divider"></div>
          <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(ADMIN_PATH . '/salir') ?>">
            <i class="bi bi-box-arrow-right me-2"></i> Salir
          </button>
        </div>
      </li>
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>
<!--end::Header-->
