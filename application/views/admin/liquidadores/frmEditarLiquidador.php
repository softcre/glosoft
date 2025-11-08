<style>
/* Fix autofill white background issue in dark mode */
.dark-mode input:-webkit-autofill {
  -webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
  -webkit-text-fill-color: #fff !important;
}
</style>

<!-- Modal header -->
<div class="modal-header bg-primary py-2 text-white">
  <h5 class="modal-title mb-0">Actualizar Liquidador</h5>
  <button type="button"
          id="cerrarModal"
          class="btn-close btn-close-white"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
</div>

<!-- Modal body -->
<div class="modal-body">
  <form id="form_liquidador"
        name="liquidador"
        method="post"
        action="<?= base_url(LIQUIDADORES_PATH . '/actualizar'); ?>"
        onsubmit="altaUpdate(event)">
        
    <input type="hidden" name="idUsuario" value="<?= $usuarios->id_usuario; ?>">

    <?php $this->load->view(LIQUIDADORES_PATH . '/_formularioEditarLiquidador'); ?>
  </form>
</div>

<!-- Modal footer -->
<div class="modal-footer bg-gradient-dark mt-0 py-1">
  <button type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal">
    <i class="fas fa-times fa-fw me-1"></i>Cerrar
  </button>

  <button type="submit"
          id="btnFormliquidador"
          form="form_liquidador"
          class="btn btn-primary"
          name="button">
    <div class="d-none">
      <span class="spinner-grow spinner-grow-sm me-1"
            role="status"
            aria-hidden="true"></span>
      Actualizando...
    </div>
    <span><i class="fas fa-pen me-2"></i>Actualizar</span>
  </button>
</div>

<script>
  // Focus field when modal is fully shown
  document.addEventListener('shown.bs.modal', function (event) {
    const personalInput = document.getElementById('Personal');
    if (personalInput) personalInput.focus();
  });
</script>
