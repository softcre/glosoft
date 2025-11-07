<table id="tblInspectores" class="table table-sm table-hover">
  <thead>
    <tr class="text-center">
      <!-- <th scope="col">DNI</th> -->
      
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Nombre</th>
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Apellido</th>
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Telefono</th>
      <th class="border-bottom border-primary bg-secondary text-light text-center" scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($usuarios as $usuario) : ?>
      <tr>
        
        <td class="text-center">
          <?= $usuario->nombre; ?>
        </td>
        <td class="text-center">
          <?= $usuario->apellido; ?>
        </td>
        <td class="text-center">
          <?= $usuario->telefono; ?>
        </td>
        <td class="text-center">

           <!-- Nuevo Grupo de Botones con Collapse -->
           <div class="btn-group btn-group-sm">
            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseButtonsMedico<?= $usuario->id_usuario ?>" aria-expanded="false" aria-controls="collapseButtonsMedico<?= $usuario->id_usuario ?>">
              <i class="fas fa-cog"></i>
            </button>
            <div class="collapse" id="collapseButtonsMedico<?= $usuario->id_usuario ?>">
              <!-- Contenido del Collapse con Botones -->
              <div class="d-flex">
                <button type="button" class="btn btn-info btn-sm mr-2" title="Ver" data-toggle="modal" data-target="#small" onclick="cargarFormSmall('<?= base_url(ADMIN_GAMERSPORT_PATH . '/frmVer/' . $usuario->id_usuario); ?>')">
                  <i class="fas fa-eye"></i>
                </button>
                <button type="button" class="btn btn-warning btn-sm mr-2" title="Editar" data-toggle="modal" data-target="#small" onclick="cargarFormSmall('<?= base_url(ADMIN_GAMERSPORT_PATH . '/frmEditar/' . $usuario->id_usuario); ?>')">
                  <i class="fas fa-pen text-white"></i>
                </button>
                
                <button type="button" class="btn btn-danger btn-sm" title="Eliminar" data-url="<?= base_url(ADMIN_GAMERSPORT_PATH . '/eliminar/' . $usuario->id_usuario); ?>" data-name="<?= $usuario->nombre.' '.$usuario->apellido; ?>" onclick="eliminarAdminGamerSport(this)">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
