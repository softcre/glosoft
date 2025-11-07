<style>
/* Fix autofill white background issue in dark mode */
.dark-mode input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
    -webkit-text-fill-color: #fff !important;
}
</style>


<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Nuevo Administrador</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_adminGamerSport" name="adminGamerSport" method="post" action="<?= base_url(ADMIN_GAMERSPORT_PATH . '/crear'); ?>" onsubmit="altaUpdate(event)">
    <input type="hidden" name="idTipoUsuario" value = "6"> <!-- cambiar a tipo usuario administrador -->

		<?php $this->load->view(ADMIN_GAMERSPORT_PATH . '/_formularioAdminGamerSport'); ?>
	</form>
</div>

<div class="modal-footer bg-gradient-dark mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnFormadminGamerSport" form="form_adminGamerSport" class="btn btn-primary" name="button">
		<div class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span><i class="fas fa-save mr-2"></i>Registrar</span>
	</button>
</div>

<script>
	/* $('.modal').on('shown.bs.modal', function() {
		$('#presentaciones').focus();
	}); */
</script>
