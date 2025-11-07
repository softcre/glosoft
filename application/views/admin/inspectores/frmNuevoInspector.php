<style>
/* Fix autofill white background issue in dark mode */
.dark-mode input:-webkit-autofill {
  -webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
  -webkit-text-fill-color: #fff !important;
}
</style>

<!-- Modal header -->
<div class="modal-header bg-primary py-2">
  <h5 class="modal-title mb-0">Nuevo Inspector</h5>
  <button type="button"
          id="cerrarModal"
          class="btn-close btn-close-white"
          data-bs-dismiss="modal"
          aria-label="Close">
  </button>
</div>

<!-- Modal body -->
<div class="modal-body">
  <form id="form_inspector"
        name="inspector"
        method="post"
        action="<?= base_url(INSPECTORES_PATH . '/crear'); ?>"
        onsubmit="altaUpdate(event)">
        
    <input type="hidden" name="idTipoUsuario" value="3"> <!-- tipo usuario inspector -->

    <?php $this->load->view(INSPECTORES_PATH . '/_formularioInspector'); ?>
  </form>
</div>

<!-- Modal footer -->
<div class="modal-footer bg-gradient-dark mt-0 py-1">
  <button type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal">
    <i class="fas fa-times fa-fw"></i> Cerrar
  </button>

  <button type="submit"
          id="btnForminspector"
          form="form_inspector"
          class="btn btn-primary"
          name="button">
    <div class="d-none">
      <span class="spinner-grow spinner-grow-sm me-1" role="status" aria-hidden="true"></span>
      Registrando...
    </div>
    <span><i class="fas fa-save me-2"></i>Registrar</span>
  </button>
</div>

<script>
// Example focus behavior if needed later
/* document.querySelector('.modal').addEventListener('shown.bs.modal', function () {
     document.querySelector('#presentaciones').focus();
}); */
</script>
