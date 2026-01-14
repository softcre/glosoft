<div class="card">
  <div class="card-body">
    <h5>Datos del empleador</h5>
    <input type="hidden" id="empleador_id" name="empleador_id" value="<?= isset($inspeccion) ? $inspeccion->empleador_id : ''; ?>">
    <div class="row">
      <div class="col-md-4 mb-2">
        <label for="empleador_cuit" class="form-label mb-0">CUIT</label>
        <div id="div_searchEmpleador"
          data-action="<?= base_url(INSPECCIONES_PATH . '/searchEmpleador'); ?>"
          data-name="SearchEmpleador">

          <div class="input-group mb-3">
            <input type="number" class="form-control" id="empleador_cuit" name="empleador_cuit" placeholder="Ingrese cuit" aria-label="Ingrese cuit" aria-describedby="button-addon2" value="<?= isset($inspeccion) ? $inspeccion->cuit : ''; ?>">

            <button type="button" id="btnFormSearchEmpleador" class="btn btn-outline-secondary" onclick="searchEmpleador(event)">
              <div class="d-none">
                <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
              </div>
              <span><i class="bi bi-person-plus-fill me-1"></i></span>
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-2">
        <label for="empleador_razon_social" class="form-label mb-0">Razón social</label>
        <input type="text" class="form-control" id="empleador_razon_social" value="<?= isset($inspeccion) ? $inspeccion->razon_social : ''; ?>" disabled>
      </div>

      <div class="col-md-4 mb-2">
        <label for="empleador_domicilio" class="form-label mb-0">Domicilio</label>
        <input type="text" class="form-control" id="empleador_domicilio" value="<?= isset($inspeccion) ? $inspeccion->domicilio : ''; ?>" disabled>
      </div>
    </div>
  </div>
</div>