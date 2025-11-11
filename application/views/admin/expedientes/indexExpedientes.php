<?php $this->load->view('admin/components/header'); ?>

<!--begin::App Main-->
<main class="app-main">
  <?php $this->load->view('admin/expedientes/_headerExpedientes'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <button
        class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#small"
        data-url="<?= base_url(EXPEDIENTES_PATH . '/frmNuevo') ?>"
        title="Nuevo expediente">
        <i class="bi bi-folder me-1"></i> Crear Expediente
      </button>

      <div class="card card-success border-success">
        <div class="card-header">
          <h3 class="card-title">Listado de Expedientes</h3>
        </div>
        <!-- /.card-header -->
        <div id="expedientes-main" class="card-body">
          <?php $this->load->view('admin/expedientes/_tblExpedientes'); ?>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</main>
<!--end::App Main-->

<?php $this->load->view('admin/components/footer'); ?>
<script src="<?= base_url(ADMIN_JS . '/expedientes.js'); ?>"></script>
