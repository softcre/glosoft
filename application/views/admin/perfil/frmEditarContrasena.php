<style>
/* Fix autofill white background issue in dark mode */
.dark-mode input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
    -webkit-text-fill-color: #fff !important;
}
</style>


<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Cambiar contraseña</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<div class="alert alert-warning py-1">
		<small>El cambio de contraseña se verá reflejado en el proximo inicio de sesión</small>
	</div>
	<form id="form_editContrasena" name="Pass" method="post" action="<?=base_url(PERFIL_PATH . '/actualizarContrasena');?>" onsubmit="altaUpdate(event)">
		<div class="form-group">
			<label for="pass_actual" class="mb-0" title="Obligatorio">Contraseña actual <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="password" class="form-control" id="pass_actual" name="pass_actual" placeholder="Introduce tu contraseña actual">
		</div>
		<div class="form-group">
			<label for="pass_nueva" class="mb-0" title="Obligatorio">Contraseña nueva <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="password" class="form-control" id="pass_nueva" name="pass_nueva" placeholder="Introduce tu contraseña nueva">
		</div>
		<div class="form-group">
			<label for="pass_conf" class="mb-0" title="Obligatorio">Repita contraseña nueva <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="password" class="form-control" id="pass_conf" name="pass_conf" placeholder="Repita su contraseña nueva">
		</div>
		<div class="text-center">
			<small class="text-muted"><span class="text-danger" title="Obligatorio">*</span> Campos obligatorios</small>
		</div>
	</form>
</div>

<!-- <div class="modal-footer bg-gradient-dark mt-0 py-1"> -->
<div class="modal-footer bg-gradient-dark mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnFormPass" form="form_editContrasena" class="btn btn-primary" name="button">
		<div class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span><i class="fas fa-pen mr-2"></i>Actualizar</span>
	</button>
</div>

<script>
	$('.modal').on('shown.bs.modal', function() {
		$('#pass_actual').focus();
	});
</script>
