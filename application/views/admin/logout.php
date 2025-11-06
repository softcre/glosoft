<div class="modal-header text-bg-success py-2">
	<h5 class="modal-title">Está a punto de salir!</h5>
	<button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body py-4">
	A continuación se cerrará la sesión de <strong><?= $_SESSION['apellido'] . ' ' . $_SESSION['nombre']; ?></strong>. ¿Continuar?
</div>

<div class="modal-footer bg-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
		<i class="bi bi-x-circle me-1"></i>Cerrar
	</button>
<form action="<?= base_url(ADMIN_PATH . '/logout'); ?>" method="POST">
	<button type="submit" class="btn btn-success" name="button">
		<i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
	</button>
</div>