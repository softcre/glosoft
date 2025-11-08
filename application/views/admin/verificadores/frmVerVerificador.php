<style>
  /* Fix autofill white background issue in dark mode */
  .dark-mode input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
    -webkit-text-fill-color: #fff !important;
  }

  /* List item alignment */
  .list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
</style>

<div class="modal-header text-bg-primary py-2">
  <h5 class="modal-title">Info Verificador</h5>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <div class="text-center mb-3">
    <h4 class="fw-bold mb-0"><?= $usuarios->nombre . ' ' . $usuarios->apellido; ?></h4>
  </div>

  <ul class="list-group list-group-flush">
    <li class="list-group-item">
      <strong>Teléfono</strong>
      <span><?= $usuarios->telefono; ?></span>
    </li>
    <li class="list-group-item">
      <strong>Email</strong>
      <span><?= $usuarios->email; ?></span>
    </li>
  </ul>
</div>

<div class="modal-footer bg-light py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>
</div>
