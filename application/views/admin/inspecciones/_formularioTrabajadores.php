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

<hr>
<div class="row">
  <div class="col-md-6 mb-2">
    <label for="cantidad_personal_perm" class="form-label mb-0">Cantidad personal permanentes</label>
    <input type="number" class="form-control" id="cantidad_personal_perm" name="cantidad_personal_perm" placeholder="Ingrese total de permanentes" value="<?= isset($inspeccion) ? $inspeccion->cantidad_personal_perm : ''; ?>">
  </div>

  <div class="col-md-6 mb-2">
    <label for="cantidad_personal_trans" class="form-label mb-0">Cantidad personal transitorios</label>
    <input type="number" class="form-control" id="cantidad_personal_trans" name="cantidad_personal_trans" placeholder="Ingrese total de transitorios" value="<?= isset($inspeccion) ? $inspeccion->cantidad_personal_trans : ''; ?>">
  </div>
</div>