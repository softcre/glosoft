
<div class="table-responsive">
  <table id="tblTrabajadores" class="table table-sm table-hover">
    <thead class="table-success">
      <tr>
        <th scope="col" class="text-center">Nombre y apellido</th>
        <th scope="col" class="text-center">DNI</th>
        <th scope="col" class="text-center">Fecha Ingreso</th>
        <th scope="col" class="text-center">Cargo</th>
        <th scope="col" class="text-center">Ult. Sueldo</th>
        <th scope="col" class="text-center">Vive en Estab.</th>
        <th scope="col" class="text-center"></th>
      </tr>
    </thead>
    <tbody class="align-middle text-center">
      <?php foreach ($trabajadores as $trabajador): ?>
        <tr>
          <td><?= concatenar($trabajador->apellido, $trabajador->nombre); ?></td>
          <td><?= $trabajador->nro_doc; ?></td>
          <td><?= formatearFecha($trabajador->fecha_ingreso); ?></td>
          <td><?= $trabajador->cargo; ?></td>
          <td><?= formatearPrecio($trabajador->remuneracion); ?></td>
          <td><?= ($trabajador->alojado_en_predio) ? 'SI' : 'NO'; ?></td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              <!-- <button type="button" class="btn btn-info" title="Ver empleado" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(EXPEDIENTES_PATH . '/frmVer/' . $trabajador->id_trabajador_encontrado) ?>">
                <i class="bi bi-eye"></i>
              </button>
              <button type="button" class="btn btn-warning" title="Editar" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(EXPEDIENTES_PATH . '/frmEditar/' . $trabajador->id_trabajador_encontrado) ?>">
                <i class="bi bi-pencil"></i>
              </button>
              <button type="button" class="btn btn-danger" title="Eliminar" data-url="<?= base_url(EXPEDIENTES_PATH . '/eliminar/' . $trabajador->id_trabajador_encontrado) ?>" data-name="<?= $trabajador->id_trabajador_encontrado; ?>" onclick="eliminar(this)">
                <i class="bi bi-trash-fill"></i>
              </button> -->
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
