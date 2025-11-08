<?php $this->load->view('admin/components/header'); ?>

<!--begin::App Main-->
<main class="app-main">
  <?php $this->load->view('admin/inspecciones/_headerInspecciones'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <button
        class="btn btn-success mb-3"
        data-bs-toggle="modal"
        data-bs-target="#small"
        data-url="<?= base_url(INSPECCIONES_PATH . '/frmNueva') ?>"
        title="Nueva Inspección">
        <i class="bi bi-binoculars-fill me-1"></i> Crear Inspección
      </button>

      <div class="card card-success border-success">
        <div class="card-header">
          <h3 class="card-title">Listado de Inspecciones</h3>
        </div>
        <!-- /.card-header -->
        <div id="inspecciones-main" class="card-body">
          <?php $this->load->view('admin/inspecciones/_tblInspecciones'); ?>
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
<script src="<?= base_url(ADMIN_JS . '/inspecciones.js'); ?>"></script>