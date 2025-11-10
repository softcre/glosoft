<style>
/* Fix autofill white background issue in dark mode */
.dark-mode input:-webkit-autofill {
  -webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
  -webkit-text-fill-color: #fff !important;
}
</style>

<!-- Modal header -->
<div class="modal-header bg-primary text-white py-2">
  <h5 class="modal-title mb-0">Nuevo Liquidador</h5>
  <button type="button"
          id="cerrarModal"
          class="btn-close btn-close-white"
          data-bs-dismiss="modal"
          aria-label="Close">
  </button>
</div>

<!-- Modal body -->
<div class="modal-body">
  <form id="form_liquidador"
        name="liquidador"
        method="post"
        action="<?= base_url(LIQUIDADORES_PATH . '/crear'); ?>"
        onsubmit="altaUpdate(event)">
        
    <input type="hidden" name="idTipoUsuario" value="5"> <!-- tipo usuario liquidador -->

    <?php $this->load->view(LIQUIDADORES_PATH . '/_formularioLiquidador'); ?>
  </form>
</div>

<!-- Modal footer -->
<div class="modal-footer bg-gradient-dark mt-0 py-1">
  <button type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i> Cerrar
  </button>

  <button type="submit"
          id="btnFormliquidador"
          form="form_liquidador"
          class="btn btn-primary"
          name="button">
    <div class="d-none">
      <span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>
      Registrando...
    </div>
    <span><i class="bi bi-floppy2-fill me-1"></i>Crear</span>
  </button>
</div>

<script>
// Example focus behavior if needed later
/* document.querySelector('.modal').addEventListener('shown.bs.modal', function () {
     document.querySelector('#presentaciones').focus();
}); */
</script>
