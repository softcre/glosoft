<div class="modal-header bg-primary text-white py-2">
	<h5 class="modal-title mb-0">¡Está a punto de salir!</h5>
	<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>

<div class="modal-body py-4 text-center">
	A continuación se cerrará la sesión de 
	<strong><?= $_SESSION['apellido'] . ' ' . $_SESSION['nombre']; ?></strong>.
	¿Desea continuar?
</div>

<div class="modal-footer  bg-gradient py-2 justify-content-center">
	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
		<i class="fas fa-times fa-fw me-1"><i class="bi bi-x-circle me-1"></i></i>Cancelar
	</button>

	<form action="<?= base_url('admin/logout'); ?>" method="POST" class="m-0">
		<button type="submit" class="btn btn-primary">
			<i class="fas fa-sign-out-alt fa-fw me-1"></i><i class="bi bi-box-arrow-right  me-1"></i>Cerrar sesión
		</button>
	</form>
</div>
