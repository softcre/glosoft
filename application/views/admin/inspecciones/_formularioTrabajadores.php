<div class="card">
  <div class="card-body">
    <h5>Datos del Personal</h5>

    <div class="row justify-content-md-center">
      <div class="col-md-4 text-center">
        <div id="div_searchAfiliacion"
          data-action="<?= base_url(INSPECCIONES_PATH . '/searchAfiliacion'); ?>"
          data-name="SearchAfiliacion">
          <input type="hidden" id="inspeccion_id" value="<?= $inspeccion->id_inspeccion; ?>">

          <div class="input-group mb-3">
            <input type="number" id="input_dni" class="form-control" placeholder="Ingrese DNI" aria-label="Ingrese DNI" aria-describedby="button-addon2">

            <button type="button" id="btnFormSearchAfiliacion" class="btn btn-outline-secondary" onclick="searchAfiliacion(event)">
              <div class="d-none">
                <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                Buscando...
              </div>
              <span><i class="bi bi-person-plus-fill me-1"></i>Agregar</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div id="trabajadores-main">
      <?php $this->load->view('admin/inspecciones/_tblTrabajadores'); ?>
    </div>
  </div>
</div>