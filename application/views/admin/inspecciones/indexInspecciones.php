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
          <?php if (permisoInspector()) : ?>
          <ul class="nav nav-tabs" id="inspeccionesTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="por-inspeccionar-tab" data-bs-toggle="tab" data-bs-target="#por-inspeccionar" type="button" role="tab">
                Por inspeccionar
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="inspeccionadas-tab" data-bs-toggle="tab" data-bs-target="#inspeccionadas" type="button" role="tab">
                Inspeccionadas
              </button>
            </li>
          </ul>
          <div class="tab-content mt-3" id="inspeccionesTabContent">
            <div class="tab-pane fade show active" id="por-inspeccionar" role="tabpanel">
              <?php $this->load->view('admin/inspecciones/_tblInspecciones', array('filtro' => 'por_hacer', 'tbl' => '1')); ?>
            </div>

            <div class="tab-pane fade" id="inspeccionadas" role="tabpanel">
              <?php endif; ?>
              <?php $this->load->view('admin/inspecciones/_tblInspecciones', array('filtro' => 'hechas', 'tbl' => '2')); ?>
              <?php if (permisoInspector()) : ?>
            </div>
          </div>
          <?php endif;?>
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