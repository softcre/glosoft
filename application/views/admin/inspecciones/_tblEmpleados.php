<div class="row">
  <div class="col-md-12 text-end mb-1">
    <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#large" data-url="<?= base_url(INSPECCIONES_PATH . '/frmNuevaAfiliacion/' . $inspeccion->id_inspeccion) ?>"><i class="bi bi-person-add me-1"></i>Agregar</button>
  </div>
</div>

<div class="table-responsive">
  <table id="tblEmpleados" class="table table-sm table-hover">
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
      <?php foreach ($empleados as $empleado): ?>
        <tr>
          <td><?= concatenar($empleado->apellido, $empleado->nombre); ?></td>
          <td><?= $empleado->documento; ?></td>
          <td><?= formatearFecha($empleado->fecha_ingreso); ?></td>
          <td><?= $empleado->categoria; ?></td>
          <td><?= formatearPrecio($empleado->remuneracion); ?></td>
          <td><?= $empleado->alojado_en_predio; ?></td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              <button type="button" class="btn btn-info" title="Ver empleado" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(EXPEDIENTES_PATH . '/frmVer/' . $empleado->id_trabajador_encontrado) ?>">
                <i class="bi bi-eye"></i>
              </button>
              <button type="button" class="btn btn-warning" title="Editar" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(EXPEDIENTES_PATH . '/frmEditar/' . $empleado->id_trabajador_encontrado) ?>">
                <i class="bi bi-pencil"></i>
              </button>
              <button type="button" class="btn btn-danger" title="Eliminar" data-url="<?= base_url(EXPEDIENTES_PATH . '/eliminar/' . $empleado->id_empleado) ?>" data-name="<?= $empleado->id_trabajador_encontrado; ?>" onclick="eliminar(this)">
                <i class="bi bi-trash-fill"></i>
              </button>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<hr>
<div class="row">
  <div class="col-md-6 mb-2">
    <label for="cantidad_personal_perm" class="form-label mb-0">Cantidad personal permanentes</label>
    <input type="number" class="form-control" id="cantidad_personal_perm" name="cantidad_personal_perm" placeholder="Ingrese total de permanentes" value="<?= !isset($inspeccion) ? $inspeccion->cantidad_personal_perm : ''; ?>">
  </div>

  <div class="col-md-6 mb-2">
    <label for="cantidad_personal_trans" class="form-label mb-0">Cantidad personal transitorios</label>
    <input type="number" class="form-control" id="cantidad_personal_trans" name="cantidad_personal_trans" placeholder="Ingrese total de transitorios" value="<?= !isset($inspeccion) ? $inspeccion->cantidad_personal_trans : ''; ?>">
  </div>
</div>