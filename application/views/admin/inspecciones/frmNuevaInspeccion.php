<div class="modal-header text-bg-success py-2">
  <h5 class="modal-title">Nueva inspección</h5>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <form id="form_newInspeccion" name="Inspeccion" method="post" action="<?= base_url(INSPECCIONES_PATH . '/crear'); ?>" onsubmit="altaUpdate(event)">
    <?php $this->load->view('admin/inspecciones/_formularioInspeccion'); ?>
  </form>
</div>

<div class="modal-footer bg-light mt-0 py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>

  <button type="submit" id="btnFormInspeccion" form="form_newInspeccion" class="btn btn-success" name="button">
    <div class="d-none">
      <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
      Creando...
    </div>
    <span><i class="bi bi-floppy2-fill me-1"></i>Crear</span>
  </button>
</div>