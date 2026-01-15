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
              <a class="btn btn-outline-danger btn-sm" href="<?= base_url(AFILIACIONES_PATH . '/pdf_ver/' . $trabajador->afiliacion_id); ?>" target="_blank" title="Acta en PDF">
                <i class="bi bi-file-earmark-pdf-fill"></i>
              </a>
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
    <input type="number" class="form-control" id="cantidad_personal_perm" name="cantidad_personal_perm" placeholder="Ingrese total de permanentes" value="<?= isset($inspeccion) ? $inspeccion->cantidad_personal_perm : ''; ?>" disabled>
  </div>

  <div class="col-md-6 mb-2">
    <label for="cantidad_personal_trans" class="form-label mb-0">Cantidad personal transitorios</label>
    <input type="number" class="form-control" id="cantidad_personal_trans" name="cantidad_personal_trans" placeholder="Ingrese total de transitorios" value="<?= isset($inspeccion) ? $inspeccion->cantidad_personal_trans : ''; ?>" disabled>
  </div>
</div>