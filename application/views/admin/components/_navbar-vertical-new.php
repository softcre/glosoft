<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand text-center py-3">
    <a href="<?= base_url(DASHBOARD_PATH); ?>" class="brand-link">
      <img
        src="<?= base_url(APP_IMG . '/logo-glosoft.png'); ?>"
        alt="Logo"
        class="brand-image opacity-75 shadow me-2" />
      <span class="brand-text fw-semibold text-white"><?= APP_NAME; ?></span>
    </a>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper px-2">
    <nav class="mt-3">
      <ul class="nav flex-column" id="navigation">

        <li class="nav-header text-secondary small fw-bold px-2 mt-2 mb-1">ETIQUETAS</li>

        <!-- === GESTIÓN DE USUARIOS === -->
        <li class="nav-item <?= ($desplegado == 'users') ? 'menu-open' : ''; ?>">
          <a class="nav-link d-flex align-items-center justify-content-between <?= ($desplegado == 'users') ? 'bg-primary text-white active' : 'text-white-50'; ?>"
             data-bs-toggle="collapse"
             href="#menuUsuarios"
             role="button"
             aria-expanded="<?= ($desplegado == 'users') ? 'true' : 'false'; ?>"
             aria-controls="menuUsuarios">
            <span><i class="bi bi-person-fill-gear me-2"></i>GESTIÓN DE USUARIOS</span>
            <i class="bi bi-chevron-right small"></i>
          </a>

          <ul class="collapse nav flex-column ms-3 border-start ps-2 <?= ($desplegado == 'users') ? 'show' : ''; ?>" id="menuUsuarios">
            <li class="nav-item">
              <a href="<?= base_url(INSPECTORES_PATH); ?>"
                 class="nav-link py-1 px-2 rounded <?= ($act == 'insp') ? 'active-sub' : 'text-white-50'; ?>">
                <i class="bi bi-person me-2"></i>Inspector
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url(VERIFICADORES_PATH); ?>"
                 class="nav-link py-1 px-2 rounded <?= ($act == 'veri') ? 'active-sub' : 'text-white-50'; ?>">
                <i class="bi bi-person me-2"></i>Verificador
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url(LIQUIDADORES_PATH); ?>"
                 class="nav-link py-1 px-2 rounded <?= ($act == 'liqu') ? 'active-sub' : 'text-white-50'; ?>">
                <i class="bi bi-person me-2"></i>Liquidador
              </a>
            </li>
          </ul>
        </li>

        <!-- === INSPECCIONES === -->
        <li class="nav-item mt-2 <?= ($desplegado == 'exp') ? 'menu-open' : ''; ?>">
          <a class="nav-link d-flex align-items-center justify-content-between <?= ($desplegado == 'exp') ? 'bg-primary text-white active' : 'text-white-50'; ?>"
             data-bs-toggle="collapse"
             href="#menuInspecciones"
             role="button"
             aria-expanded="<?= ($desplegado == 'exp') ? 'true' : 'false'; ?>"
             aria-controls="menuInspecciones">
            <span><i class="bi bi-binoculars-fill me-2"></i>INSPECCIONES</span>
            <i class="bi bi-chevron-right small"></i>
          </a>

          <ul class="collapse nav flex-column ms-3 border-start ps-2 <?= ($desplegado == 'exp') ? 'show' : ''; ?>" id="menuInspecciones">
            <li class="nav-item">
              <a href="<?= base_url(INSPECCIONES_PATH); ?>"
                 class="nav-link py-1 px-2 rounded <?= ($act == 'acta') ? 'active-sub' : 'text-white-50'; ?>">
                <i class="bi bi-card-checklist me-2"></i>Inspecciones
              </a>
            </li>
          </ul>
        </li>

      </ul>
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
