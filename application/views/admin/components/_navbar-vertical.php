<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand text-center py-3">
    <a href="<?= base_url(DASHBOARD_PATH); ?>" class="brand-link d-inline-flex align-items-center text-decoration-none">
      <img
        src="<?= base_url(APP_IMG . '/logo-glosoft.png'); ?>"
        alt="Logo"
        class="brand-image opacity-75 shadow me-2"
        style="width: 36px; height: 36px;" />
      <span class="brand-text fw-semibold text-light"><?= APP_NAME; ?></span>
    </a>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper px-2">
    <nav class="mt-3">
      <ul class="nav flex-column sidebar-menu" id="navigation" role="navigation" aria-label="Main navigation">

        <!-- <li class="nav-header text-uppercase small fw-bold text-secondary px-2 mb-2">Etiquetas</li> -->
        <?php if (permisoAdmin()) : ?>
          <!-- === Users Section (Blue Theme) === -->
          <li class="nav-item has-treeview <?= ($desplegado == 'users') ? 'menu-is-opening menu-open' : ''; ?>" data-menu="users">
            <a href="#" class="nav-link d-flex justify-content-between align-items-center <?= ($desplegado == 'users') ? 'active' : ''; ?>">
              <span><i class="nav-icon bi bi-person-fill-gear me-2"></i> Gestión de Usuarios</span>
              <i class="bi bi-chevron-right nav-arrow"></i>
            </a>
            <ul class="nav nav-treeview list-unstyled ps-0">
              <li class="nav-item">
                <a href="<?= base_url(INSPECTORES_PATH); ?>" class="nav-link <?= ($act == 'insp') ? 'active' : ''; ?>">
                  <!--  <i class="bi bi-person me-2"></i> --><i class="bi bi-person-fill me-2"></i> Inspector
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(VERIFICADORES_PATH); ?>" class="nav-link <?= ($act == 'veri') ? 'active' : ''; ?>">
                  <!--  <i class="bi bi-person me-2"></i> --><i class="bi bi-person-fill me-2"></i> Verificador
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(LIQUIDADORES_PATH); ?>" class="nav-link <?= ($act == 'liqu') ? 'active' : ''; ?>">
                  <!--  <i class="bi bi-person me-2"></i> --><i class="bi bi-person-fill me-2"></i> Liquidador
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(USERS_ELIMINADOS_PATH); ?>" class="nav-link <?= ($act == 'elim') ? 'active' : ''; ?>">
                  <i class="bi bi-person-fill-x me-2"></i>Eliminados
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

        <!-- === Inspecciones Section (Green Theme) === -->
        <li class="nav-item has-treeview <?= ($desplegado == 'exp') ? 'menu-is-opening menu-open' : ''; ?>" data-menu="exp">
          <a href="#" class="nav-link d-flex justify-content-between align-items-center <?= ($desplegado == 'exp') ? 'active' : ''; ?>">
            <span><i class="nav-icon bi bi-folder me-2"></i> Expedientes</span>
            <i class="bi bi-chevron-right nav-arrow"></i>
          </a>
          <ul class="nav nav-treeview list-unstyled ps-0">
            <?php if (permisoAdmin()): ?>
              <li class="nav-item">
                <a href="<?= base_url(EXPEDIENTES_PATH); ?>" class="nav-link <?= ($act == 'expe') ? 'active' : ''; ?>">
                  <i class="bi bi-folder2-open me-2"></i> Expedientes
                </a>
              </li>
            <?php endif; ?>
            <?php if (permisoInspector() || permisoVerificador()): ?>
              <li class="nav-item">
                <a href="<?= base_url(INSPECCIONES_PATH); ?>" class="nav-link <?= ($act == 'acta') ? 'active' : ''; ?>">
                  <i class="bi bi-binoculars-fill me-2"></i> Inspecciones
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </li>

      </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

<style>
  /* === Base Sidebar === */
  .app-sidebar {
    width: 260px;
    min-height: 100vh;
    background-color: #212529;
    color: #adb5bd;
  }

  /* Default link look */
  .app-sidebar .nav-link {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    color: #adb5bd;
    transition: background-color 0.2s ease, color 0.2s ease;
  }

  .app-sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.05);
    color: #fff !important;
  }

  /* Chevron rotation */
  .menu-open>.nav-link .nav-arrow {
    transform: rotate(90deg);
    transition: transform 0.2s ease;
  }

  /* Submenu container */
  .app-sidebar .nav-treeview {
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    margin-left: 1.25rem;
    padding-left: 0.25rem;
  }

  /* Submenu links */
  .app-sidebar .nav-treeview .nav-link {
    padding-left: 1.75rem;
    font-size: 0.92rem;
    color: #adb5bd;
    background-color: transparent;
    transition: all 0.15s ease;
  }

  /* === Theme Variables per Section === */
  .app-sidebar .nav-item[data-menu="users"] {
    --menu-color: #0b5ed7;
    --menu-color-dark: #0a58ca;
    --menu-sub-bg: #e9f2ff;
    --menu-sub-bg-hover: #d6e6ff;
  }

  .app-sidebar .nav-item[data-menu="exp"] {
    --menu-color: #198754;
    --menu-color-dark: #157347;
    --menu-sub-bg: #e7f7ef;
    --menu-sub-bg-hover: #d4f0e3;
  }

  /* === Themed Behaviors (uses variables) === */
  .app-sidebar .nav-item[data-menu]>.nav-link.active {
    background-color: var(--menu-color) !important;
    color: #fff !important;
    border-left: 4px solid var(--menu-color-dark);
    font-weight: 600;
  }

  .app-sidebar .nav-item[data-menu] .nav-treeview .nav-link:hover {
    background-color: color-mix(in srgb, var(--menu-color) 25%, transparent);
    color: #f8f9fa !important;
  }

  .app-sidebar .nav-item[data-menu] .nav-treeview .nav-link.active {
    background-color: var(--menu-sub-bg) !important;
    color: var(--menu-color) !important;
    font-weight: 600;
    border-left: 3px solid var(--menu-color);
    border-radius: 0 0.375rem 0.375rem 0;
  }

  .app-sidebar .nav-item[data-menu] .nav-treeview .nav-link.active:hover {
    background-color: var(--menu-sub-bg-hover) !important;
    color: var(--menu-color-dark) !important;
  }

  /* Section header */
  .nav-header {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Toggle open/close without jQuery
    document.querySelectorAll(".app-sidebar .nav-item.has-treeview > .nav-link").forEach(function(toggleLink) {
      toggleLink.addEventListener("click", function(e) {
        e.preventDefault();
        const parent = this.closest(".nav-item");
        const submenu = parent.querySelector(".nav-treeview");
        if (!submenu) return;

        const isOpen = parent.classList.contains("menu-open");
        document.querySelectorAll(".app-sidebar .nav-item.has-treeview.menu-open").forEach(function(item) {
          if (item !== parent) {
            item.classList.remove("menu-open");
            item.querySelector(".nav-treeview").style.display = "none";
          }
        });

        if (isOpen) {
          submenu.style.display = "none";
          parent.classList.remove("menu-open");
        } else {
          submenu.style.display = "block";
          parent.classList.add("menu-open");
        }
      });
    });

    // Keep active section expanded on load
    document.querySelectorAll(".app-sidebar .nav-item.has-treeview").forEach(function(item) {
      const activeSub = item.querySelector(".nav-link.active");
      if (activeSub) {
        item.classList.add("menu-open");
        const submenu = item.querySelector(".nav-treeview");
        if (submenu) submenu.style.display = "block";
      }
    });
  });
</script>