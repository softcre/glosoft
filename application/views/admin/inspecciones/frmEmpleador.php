<div class="modal-header text-bg-success py-2">
  <h5 class="modal-title">Empleador</h5>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <form id="form_Empleador" name="Empleador" method="post" action="<?= base_url(INSPECCIONES_PATH . '/saveEmpleador'); ?>" onsubmit="altaUpdate(event)">
    <input type="hidden" name="id_empleador" value="<?= isset($empleador) ? $empleador->id_empleador : ''; ?>">
    <div class="row">
      <div class="col-md-4 mb-2">
        <label for="cuit" class="form-label mb-0" title="Obligatorio">CUIT <span class="text-danger" title="Obligatorio">*</span></label>
        <input type="number" class="form-control bg-light" id="cuit" name="cuit" placeholder="Ingrese cuit" value="<?= isset($empleador) ? $empleador->cuit : $cuit; ?>" readonly>
      </div>

      <div class="col-md-4 mb-2">
        <label for="razon_social" class="form-label mb-0" title="Obligatorio">Razón Social <span class="text-danger" title="Obligatorio">*</span></label>
        <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingrese razon social" value="<?= isset($empleador) ? $empleador->razon_social : ''; ?>">
      </div>

      <div class="col-md-4 mb-2">
        <label for="responsable_nombre" class="form-label mb-0" title="Obligatorio">Responsable a cargo <span class="text-danger" title="Obligatorio">*</span></label>
        <input type="text" class="form-control" id="responsable_nombre" name="responsable_nombre" placeholder="Ingrese responsable a cargo" value="<?= isset($empleador) ? $empleador->responsable_nombre : ''; ?>">
      </div>

      <div class="col-md-4 mb-2">
        <label for="telefono" class="form-label mb-0" title="Obligatorio">Teléfono <span class="text-danger" title="Obligatorio">*</span></label>
        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese teléfono" value="<?= isset($empleador) ? $empleador->telefono : ''; ?>">
      </div>

      <div class="col-md-4 mb-2">
        <label for="domicilio" class="form-label mb-0" title="Obligatorio">Domicilio <span class="text-danger" title="Obligatorio">*</span></label>
        <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Ingrese domicilio" value="<?= isset($empleador) ? $empleador->domicilio : ''; ?>">
      </div>

      <div class="col-md-4 mb-2">
        <label for="localidad" class="form-label mb-0">Localidad</label>
        <input type="text" class="form-control" id="localidad" name="localidad" placeholder="Ingrese localidad" value="<?= isset($empleador) ? $empleador->localidad : ''; ?>">
      </div>

      <div class="col-md-4 mb-2">
        <label for="provincia" class="form-label mb-0">Provincia</label>
        <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Ingrese provincia" value="<?= isset($empleador) ? $empleador->provincia : ''; ?>">
      </div>

      <div class="col-md-4 mb-2">
        <label for="actividad" class="form-label mb-0">Actividad</label>
        <input type="text" class="form-control" id="actividad" name="actividad" placeholder="Ingrese actividad" value="<?= isset($empleador) ? $empleador->actividad : ''; ?>">
      </div>
    </div>
  </form>
</div>

<div class="modal-footer bg-light mt-0 py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>

  <button type="submit" id="btnFormEmpleador" form="form_Empleador" class="btn btn-success" name="button">
    <div class="d-none">
      <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
      Guadando...
    </div>
    <span><i class="bi bi-floppy2-fill me-1"></i>Guardar</span>
  </button>
</div>