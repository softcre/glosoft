<div class="modal-header text-bg-success py-2">
  <h5 class="modal-title">Editar inspección</h5>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <form id="form_editarInspeccion" name="Inspeccion" method="post" action="<?= base_url(INSPECCIONES_PATH . '/actualizar'); ?>" onsubmit="altaUpdate(event)">
    <input type="hidden" name="id_inspeccion" value="<?= $inspeccion->id_inspeccion; ?>">
    <?php $this->load->view('admin/inspecciones/_formularioInspeccion'); ?>
  </form>
</div>

<div class="modal-footer bg-light mt-0 py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>

  <button type="submit" id="btnFormInspeccion" form="form_editarInspeccion" class="btn btn-success" name="button">
    <div class="d-none">
      <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
      Actualizando...
    </div>
    <span><i class="bi bi-pencil me-1"></i>Actualizar</span>
  </button>
</div>