<table id="tblEliminados" class="table table-sm table-hover align-middle">
  <thead>
    <tr class="text-center">
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Nombre</th>
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Apellido</th>
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Teléfono</th>
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Acciones</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($usuarios as $usuario): ?>
      <tr>
        <td class="text-center"><?= $usuario->nombre; ?></td>
        <td class="text-center"><?= $usuario->apellido; ?></td>
        <td class="text-center"><?= $usuario->telefono; ?></td>
        <td class="text-center">

          <div class="d-inline-flex align-items-center justify-content-center gap-2">
            <!-- Toggle (horizontal dots for “more”) -->
            <button
              class="btn btn-primary btn-sm toggle-more"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseButtonsMedico<?= $usuario->id_usuario ?>"
              aria-expanded="false"
              aria-controls="collapseButtonsMedico<?= $usuario->id_usuario ?>">
              <i class="bi bi-three-dots"></i>
            </button>

            <!-- Collapsible Button Group (inline, horizontal) -->
            <div class="collapse collapse-horizontal" id="collapseButtonsMedico<?= $usuario->id_usuario ?>">
              <div class="d-inline-flex align-items-center gap-2 ms-2">
                
                <!-- Ver -->
                <!-- <button
                  type="button"
                  class="btn btn-info btn-sm"
                  title="Ver"
                  data-bs-toggle="modal"
                  data-bs-target="#small"
                  onclick="cargarFormSmall('<?= base_url(INSPECTORES_PATH . '/frmVer/' . $usuario->id_usuario); ?>')">
                  <i class="bi bi-eye-fill"></i>
                </button> -->

                <!-- Editar -->
              <!--   <button
                  type="button"
                  class="btn btn-warning btn-sm"
                  title="Editar"
                  data-bs-toggle="modal"
                  data-bs-target="#small"
                  onclick="cargarFormSmall('<?= base_url(INSPECTORES_PATH . '/frmEditar/' . $usuario->id_usuario); ?>')">
                  <i class="bi bi-pencil-square"></i>
                </button> -->

                <!-- Eliminar -->
                <button
                  type="button"
                  class="btn btn-success btn-sm"
                  title="Restaurar"
                  data-url="<?= base_url(USERS_ELIMINADOS_PATH . '/restaurar/' . $usuario->id_usuario); ?>"
                  data-name="<?= $usuario->nombre . ' ' . $usuario->apellido; ?>"
                  onclick="restaurarUser(this)">
                  <!-- <i class="bi bi-trash-fill"></i> -->
                  <i class="bi bi-recycle"></i>
                </button>
              </div>
            </div>
          </div>

        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<style>
.toggle-more i {
  display: inline-block;
  transition: transform 0.25s ease;
}

.toggle-more[aria-expanded="true"] i {
  transform: rotate(90deg);
}
.collapse-horizontal {
  transition: width 0.25s ease;
}
</style>
