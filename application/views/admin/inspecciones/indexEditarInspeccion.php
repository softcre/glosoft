<?php $this->load->view('admin/components/header'); ?>

<!--begin::App Main-->
<main class="app-main">
  <?php $this->load->view('admin/inspecciones/_headerInspecciones'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-success border-success">
        <div class="card-header">
          <h3 class="card-title">Acta de Inspección</h3>
        </div>
        <!-- /.card-header -->
        <div id="inspecciones-main" class="card-body">
          <form id="form_editarInspeccion" name="Inspeccion" method="post" action="<?= base_url(INSPECCIONES_PATH . '/actualizar'); ?>" onsubmit="altaUpdate(event)">
            <input type="hidden" name="id_inspeccion" value="<?= $inspeccion->id_inspeccion; ?>">
            <?php $this->load->view('admin/inspecciones/_formularioMainInspeccion'); ?>

            <div class="text-end mt-2">
              <button type="submit" class="btn btn-primary" name="btnGuardar">Guardar</button>
              <button type="submit" class="btn btn-success" name="btnVerificar">Enviar a verificar</button>
            </div>
          </form>
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