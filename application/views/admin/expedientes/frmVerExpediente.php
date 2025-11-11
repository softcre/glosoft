<div class="modal-header text-bg-success py-2">
  <h5 class="modal-title"><i class="bi bi-file-text-fill me-2"></i>Info Expediente</h5>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <dl class="row mb-0 align-items-center">
    <dt class="col-sm-4 fw-bold text-muted">N° de Expediente:</dt>
    <dd class="col-sm-8 fs-5 text-primary text-end"><?= $expediente->id_expediente; ?></dd>

    <dt class="col-sm-4 fw-bold text-muted">Fecha:</dt>
    <dd class="col-sm-8 text-end"><?= formatearFecha($expediente->fecha_expediente); ?></dd>

    <dt class="col-sm-4 fw-bold text-muted">Ubicación:</dt>
    <dd class="col-sm-8 text-end"><?= $expediente->ubicacion; ?></dd>

    <dt class="col-sm-4 fw-bold text-muted">Inspector a Cargo:</dt>
    <dd class="col-sm-8 text-end"><?= concatenar($expediente->inspector_apellido, $expediente->inspector_nombre); ?></dd>
  </dl>
</div>

<div class="modal-footer bg-light mt-0 py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>
</div>