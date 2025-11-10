<div class="modal-header text-bg-success py-2">
  <h5 class="modal-title"><i class="bi bi-file-text-fill me-2"></i>Info Inspección</h5>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <dl class="row mb-0 align-items-center">
    <dt class="col-sm-5 fw-bold text-muted">Número de Acta:</dt>
    <dd class="col-sm-7 fs-5 text-primary text-end"><?= $inspeccion->numero_acta; ?></dd>

    <dt class="col-sm-5 fw-bold text-muted">Ubicación:</dt>
    <dd class="col-sm-7 text-end"><?= $inspeccion->ubicacion; ?></dd>

    <dt class="col-sm-5 fw-bold text-muted">Inspector a Cargo:</dt>
    <dd class="col-sm-7 text-end"><?= $inspeccion->inspector_apellido . ' ' . $inspeccion->inspector_nombre; ?></dd>
  </dl>
</div>

<div class="modal-footer bg-light mt-0 py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>
</div>