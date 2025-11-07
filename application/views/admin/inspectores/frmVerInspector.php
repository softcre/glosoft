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

<div class="card border-primary">
  <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <span class="card-title mb-0">Info Administrador</span>
    <button type="button"
            id="cerrarModal"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
  </div>

  <div class="card-body">
    <h3 class="text-center mb-3">
      <?= $usuarios->nombre . ' ' . $usuarios->apellido; ?>
    </h3>

    <ul class="list-group list-group-flush mt-1">
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
</div>
