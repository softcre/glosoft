<?php $this->load->view('admin/components/header'); ?>

<!--begin::App Main-->
<main class="app-main">
  <?php $this->load->view('admin/inspecciones/_headerInspecciones'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-success border-success">
        <div class="card-header">
          <h3 class="card-title">Listado de Inspeccions</h3>
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
