<?php $this->load->view(ADMIN_PATH . '/components/header'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php $this->load->view(INSPECTORES_PATH . '/_headerInspector'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      
    <!--  -->
    <!--  -->
    
    <!--  -->
    <div class="button-container">
      <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#small" onclick="cargarFormSmall('<?= base_url(INSPECTORES_PATH . '/frmNueva') ?>')" title="Nuevo Inspector">
          <i class="fas fa-plus fa-fw"></i> Agregar Inspector
      </button>

      <!-- <a href="<?= base_url(INSPECTORES_PATH); ?>" class="btn btn-secondary">
          <i class="fas fa-arrow-left fa-fw"></i> Volver a Médicos
      </a> -->
    </div>
    <!--  -->

    
    <!--  -->
      
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Listado de Inspectores</h3>
        </div>
        <div id="inspectores-main" class="card-body">
          <?php $this->load->view(INSPECTORES_PATH . '/_tblInspectores'); ?>
        </div>
      </div>
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view(ADMIN_PATH . '/components/footer'); ?>
<script src="<?= base_url('assets/admin/js/inspectores.js'); ?>"></script>
<style>
  /* .list-group-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
  }

  .button-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  } */
  /* .list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
  } */

  /* Optional: Add some spacing between the buttons */
  /* .button-container a {
      margin-right: 10px;
  } */
</style>
<style>
    .button-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    /* Optional: Add some spacing between the buttons */
    .button-container button,
    .button-container a {
        margin-right: 10px;
    }
</style>