<style>
	/* Fix autofill white background issue in dark mode */
	.dark-mode input:-webkit-autofill {
		-webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
		-webkit-text-fill-color: #fff !important;
	}
</style>


<div class="modal-header text-bg-success py-2">
	<h5 class="modal-title">Cambiar contraseña</h5>
	<button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
	<div class="alert alert-warning py-1">
		<small>El cambio de contraseña se verá reflejado en el proximo inicio de sesión</small>
	</div>
	<form id="form_editContrasena" name="Pass" method="post" action="<?= base_url(PERFIL_PATH . '/actualizarContrasena'); ?>" onsubmit="altaUpdate(event)">

		<div class="mb-3">
			<label for="pass_actual" class="form-label mb-0" title="Obligatorio">Contraseña actual <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="password" class="form-control" id="pass_actual" name="pass_actual" placeholder="Introduce tu contraseña actual">
		</div>

		<div class="mb-3">
			<label for="pass_nueva" class="form-label mb-0" title="Obligatorio">Contraseña nueva <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="password" class="form-control" id="pass_nueva" name="pass_nueva" placeholder="Introduce tu contraseña nueva">
		</div>

		<div class="mb-3">
			<label for="pass_conf" class="form-label mb-0" title="Obligatorio">Repita contraseña nueva <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="password" class="form-control" id="pass_conf" name="pass_conf" placeholder="Repita su contraseña nueva">
		</div>

		<div class="text-center">
			<small class="text-muted"><span class="text-danger" title="Obligatorio">*</span> Campos obligatorios</small>
		</div>
	</form>
</div>

<div class="modal-footer bg-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
		<i class="bi bi-x-circle me-1"></i>Cerrar
	</button>

	<button type="submit" id="btnFormPass" form="form_editContrasena" class="btn btn-success" name="button">
		<div class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span><i class="bi bi-pencil me-1"></i>Actualizar</span>
	</button>
</div>

<script>
	// $('.modal').on('shown.bs.modal', function() {
	// 	$('#pass_actual').focus();
	// });

	const miModal = document.getElementById('large');

	if (miModal) {
		miModal.addEventListener('shown.bs.modal', function() {
			setTimeout(function() {
				document.getElementById('pass_actual').focus();
			}, 100);
		});
	}
</script>