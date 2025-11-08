<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="<?= base_url(DASHBOARD_PATH); ?>" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="<?= base_url(APP_IMG . '/logo-glosoft.png'); ?>"
        alt="Logo"
        class="brand-image opacity-75 shadow" />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light"><?= APP_NAME; ?></span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation">

        <li class="nav-header">ETIQUETAS</li>

        <!-- <li class="nav-item menu-open">
          <a href="#" class="nav-link active"> -->
        <li class="nav-item has-treeview <?= ($desplegado == 'users') ? 'menu-is-opening menu-open' : ''; ?>">
          <a href="#" class="nav-link <?= ($desplegado == 'users') ? 'active' : ''; ?>">
            <!-- <i class="nav-icon bi bi-clipboard-fill"></i> -->
            <i class="nav-icon bi bi-person-fill-gear"></i>
            <p>
              GESTION DE USUARIOS
              <span class="nav-badge badge text-bg-primary me-3"></span>
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <!--  <a href="./layout/unfixed-sidebar.html" class="nav-link active"> -->
              <a href="<?= base_url(INSPECTORES_PATH); ?>" class="nav-link <?= ($act == 'insp') ? 'active' : '' ?>">
                <!-- <i class="nav-icon bi bi-circle"></i> -->
                <i class="nav-icon bi bi-person"></i>
                <p>Inspector</p>
              </a>
            </li>
            <li class="nav-item">
              <!-- <a href="./layout/unfixed-sidebar.html" class="nav-link"> -->
              <a href="<?= base_url(VERIFICADORES_PATH); ?>" class="nav-link <?= ($act == 'veri') ? 'active' : '' ?>">
                <!-- <i class="nav-icon bi bi-circle"> -->
                <i class="nav-icon bi bi-person"></i>
                <p>Verificador</p>
              </a>
            </li>
            <li class="nav-item">
              <!-- <a href="./layout/unfixed-sidebar.html" class="nav-link"> -->
                <a href="<?= base_url(LIQUIDADORES_PATH); ?>" class="nav-link <?= ($act == 'liqu') ? 'active' : '' ?>">
                <!-- <i class="nav-icon bi bi-circle"></i> -->
                <i class="nav-icon bi bi-person"></i>
                <p>Liquidador</p>
              </a>
            </li>
          </ul>
        </li>
        <br>
        <li class="nav-item has-treeview <?= ($desplegado == 'exp') ? 'menu-is-opening menu-open' : ''; ?>">
          <a href="#" class="nav-link <?= ($desplegado == 'exp') ? 'active' : ''; ?>">
            <!-- <i class="nav-icon bi bi-clipboard-fill"></i> -->
            <i class="nav-icon bi bi-person-fill-gear"></i>
            <p>
              INSPECCIONES
              <span class="nav-badge badge text-bg-secondary me-3"></span>
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url(INSPECCIONES_PATH); ?>" class="nav-link <?= ($act == 'acta') ? 'active' : '' ?>">
                <i class="nav-icon bi bi-binoculars-fill"></i>
                <p>Inspecciones</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
<style>
/* === Custom Highlight Styling === */

/* Parent active section (menu open) */
.app-sidebar .nav-link.active,
.app-sidebar .nav-link.bg-primary {
  background-color: #0b5ed7 !important;
  color: #fff !important;
}

/* Sub-item active */
.app-sidebar .nav-link.active-sub {
  background-color: #fff !important;
  color: #0b5ed7 !important;
  font-weight: 600;
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
}

/* Hover states */
.app-sidebar .nav-link:hover {
  background-color: rgba(13, 110, 253, 0.2);
  color: #fff !important;
}

/* Submenu items */
.app-sidebar .nav-treeview .nav-link {
  font-size: 0.9rem;
}

/* Chevron rotation when open */
.menu-open > .nav-link i.bi-chevron-right {
  transform: rotate(90deg);
  transition: transform 0.2s ease;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.app-sidebar .collapse').forEach(function (collapseEl) {
    collapseEl.addEventListener('show.bs.collapse', function () {
      const parentLi = this.closest('.nav-item');
      if (parentLi) parentLi.classList.add('menu-open');
    });
    collapseEl.addEventListener('hide.bs.collapse', function () {
      const parentLi = this.closest('.nav-item');
      if (parentLi) parentLi.classList.remove('menu-open');
    });
  });
});
</script>