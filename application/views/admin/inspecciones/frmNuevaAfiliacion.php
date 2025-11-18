<div class="modal-header text-bg-success py-2">
  <h5 class="modal-title">Nueva afiliación</h5>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <div class="row justify-content-md-center">
    <div class="col-md-4 text-center">
      <form id="form_searchAfiliacion" name="SearchAfiliacion" method="post" action="<?= base_url(INSPECCIONES_PATH . '/searchAfiliacion'); ?>" onsubmit="searchAfiliacion(event)">
        <input type="hidden" name="inspeccion_id" value="<?= $inspeccion_id; ?>?>">

        <div class="input-group mb-3">
          <input type="number" class="form-control" name="dni" placeholder="Ingrese DNI" aria-label="Ingrese DNI" aria-describedby="button-addon2" required>
          <button type="submit" id="btnFormSearchAfiliacion" class="btn btn-outline-secondary">
            <div class="d-none">
              <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
              Buscando...
            </div>
            <span><i class="bi bi-search me-1"></i>Buscar</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <form id="form_newAfiliacion" name="Afiliado" class="d-none" method="post" action="<?= base_url(INSPECCIONES_PATH . '/crearAfiliacion'); ?>" onsubmit="altaUpdate(event)">
    <?php $this->load->view('admin/inspecciones/_formularioAfiliacion'); ?>
  </form>
</div>

<div class="modal-footer bg-light mt-0 py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>

  <button type="submit" id="btnFormAfiliacion" form="form_newAfiliacion" class="btn btn-success d-none" name="button">
    <div class="d-none">
      <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
      Creando...
    </div>
    <span><i class="bi bi-floppy2-fill me-1"></i>Crear</span>
  </button>
</div>