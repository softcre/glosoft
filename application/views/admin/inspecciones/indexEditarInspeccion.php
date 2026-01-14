<?php $this->load->view('admin/components/header'); ?>

<!--begin::App Main-->
<main class="app-main">
  <?php $this->load->view('admin/inspecciones/_headerInspecciones'); ?>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form id="form_editarInspeccion" name="Inspeccion" method="post" action="<?= base_url(INSPECCIONES_PATH . '/actualizar'); ?>" onsubmit="altaUpdate(event)">
        <div class="card card-light border-success">
          <div class="card-header bg-secondary-subtle d-flex justify-content-between align-items-center">

            <div>
              <h3 class="mb-0">Acta de Inspección</h3>
              <small>Nro. Acta: <?= $inspeccion_id; ?></small>
            </div>

            <div class="ms-auto d-flex gap-2">
              <button
                type="submit"
                id="btnFormInspeccion"
                class="btn btn-primary"
                onclick="$('#submit_action').val('btnGuardarBorrador');"
                name="btnGuardarBorrador">
                <div class="d-none">
                  <span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>
                  Guardando...
                </div>
                <span><i class="bi bi-floppy2-fill me-1"></i>Guardar</span>
              </button>

              <button
                type="submit"
                class="btn btn-success"
                onclick="$('#submit_action').val('btnGuardarVerificar');"
                name="btnGuardarVerificar">
                <div class="d-none">
                  <span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>
                  Enviando a verificar...
                </div>
                <span><i class="bi bi-floppy2-fill me-1"></i>Enviar a verificar</span>
              </button>
            </div>

          </div>
          <!-- /.card-header -->
          <div id="inspecciones-main" class="card-body">

            <input type="hidden" id="submit_action" name="submit_action" value="">
            <input type="hidden" name="id_expediente" value="<?= $id_expediente; ?>">
            <input type="hidden" name="id_inspeccion" value="<?= $inspeccion->id_inspeccion; ?>">
            <?php $this->load->view('admin/inspecciones/_formularioMainInspeccion'); ?>

            <!-- <div class="text-end mt-2">
              <button type="submit" id="btnFormInspeccion" class="btn btn-primary" onclick="$('#submit_action').val('btnGuardarBorrador');" name="btnGuardarBorrador">
                <div class="d-none">
                  <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                  Guardando...
                </div>
                <span><i class="bi bi-floppy2-fill me-1"></i>Guardar</span>
              </button>

              <button type="submit" id="btnFormInspeccion" class="btn btn-success" onclick="$('#submit_action').val('btnGuardarVerificar');" name="btnGuardarVerificar">
                <div class="d-none">
                  <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                  Enviando a verificar...
                </div>
                <span><i class="bi bi-floppy2-fill me-1"></i>Enviar a verificar</span>
              </button>
            </div> -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </form>
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</main>
<!--end::App Main-->

<?php $this->load->view('admin/components/footer'); ?>
<script src="<?= base_url(ADMIN_JS . '/inspecciones.js'); ?>"></script>