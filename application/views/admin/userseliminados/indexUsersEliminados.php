<?php $this->load->view(ADMIN_PATH . '/components/header'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <?php $this->load->view(USERS_ELIMINADOS_PATH . '/_headerUserEliminado'); ?>

  <!-- Main content -->
  <section class="content py-3">
    <div class="container-fluid">

      <!-- Action Buttons -->
      <div class="button-container mb-3">
        <!-- <button 
          class="btn btn-primary" 
          data-bs-toggle="modal" 
          data-bs-target="#small" 
          data-url="<?= base_url(USERS_ELIMINADOS_PATH . '/frmNueva') ?>" 
          title="Nuevo Inspector">
          </i><i class="bi bi-person-fill-add me-1"></i> Crear Inspector
        </button> -->

        <!-- Example secondary button -->
        <!--
        <a href="<?= base_url(USERS_ELIMINADOS_PATH); ?>" class="btn btn-secondary">
          <i class="bi bi-arrow-left-circle me-1"></i> Volver a Médicos
        </a>
        -->
      </div>

      <!-- eliminados List -->
      <div class="card border-primary shadow-sm">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title mb-0">Listado de Usuarios Eliminados</h3>
        </div>
        <div id="eliminados-main" class="card-body">
          <?php $this->load->view(USERS_ELIMINADOS_PATH . '/_tblEliminados'); ?>
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(ADMIN_PATH . '/components/footer'); ?>

<script src="<?= base_url('assets/admin/js/eliminados.js'); ?>"></script>

<style>
  .button-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
  }

  .button-container button,
  .button-container a {
      margin-right: 10px;
  }
</style>
