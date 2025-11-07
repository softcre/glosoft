<style>
/* Fix autofill white background issue in dark mode */
.dark-mode input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #343a40 inset !important;
    -webkit-text-fill-color: #fff !important;
}
</style>


<div class="card card-primary">
    <div class="card-header">
        <div class="card-title">Info Administrador</div>
        <button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="card-body">
		<h3 class="text-center"><?= $usuarios->nombre.' '.$usuarios->apellido; ?></h3>

		<ul class="list-group list-group-unbordered mt-1">
    
  
      <li class="list-group-item">
				<strong>Teléfono</strong>
				<p class="float-right mb-0">
					<?= $usuarios->telefono; ?>
				</p>
			</li>
      <li class="list-group-item">
				<strong>Email</strong>
				<p class="float-right mb-0">
					<?= $usuarios->email; ?>
				</p>
			</li>
		</ul>
    </div>
</div>
<style>
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>


