<div class="table-responsive">
  <table id="<?= isset($table_id) ? $table_id : 'tblExpedientes'; ?>" class="table table-sm table-hover">
    <thead class="table-success">
      <tr>
        <th scope="col" class="text-center">N° Expediente</th>
        <th scope="col" class="text-center">Ubicación</th>
        <th scope="col" class="text-center">Provincia</th>
        <th scope="col" class="text-center">Localidad</th>
        <th scope="col" class="text-center">Fecha</th>
        <th scope="col" class="text-center">Inspector asignado</th>
        <th scope="col" class="text-center">Estado</th>
        <th scope="col" class="text-center"></th>
      </tr>
    </thead>
    <tbody class="align-middle text-center">
      <?php foreach ($expedientes as $expediente): ?>
        <tr>
          <td><?= $expediente->id_expediente; ?></td>
          <td><?= $expediente->ubicacion; ?></td>
          <td><?= isset($expediente->provincia_nombre) ? $expediente->provincia_nombre : '-'; ?></td>
          <td><?= isset($expediente->localidad_nombre) ? $expediente->localidad_nombre : '-'; ?></td>
          <td><?= formatearFecha($expediente->fecha_expediente); ?></td>
          <td><?= concatenar($expediente->inspector_apellido, $expediente->inspector_nombre); ?></td>
          <td>
            <span class="badge <?= colorEstadoInspeccion($expediente->nombre_estado); ?>"><?= $expediente->nombre_estado; ?></span>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              <button type="button" class="btn btn-info" title="Ver expediente" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(EXPEDIENTES_PATH . '/frmVer/' . $expediente->id_expediente) ?>">
                <i class="bi bi-eye"></i>
              </button>
              <button type="button" class="btn btn-warning" title="Editar" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(EXPEDIENTES_PATH . '/frmEditar/' . $expediente->id_expediente) ?>">
                <i class="bi bi-pencil"></i>
              </button>
              <a class="btn btn-outline-danger btn-sm" href="<?= base_url(INSPECCIONES_PATH . '/pdf_ver/' . $expediente->inspeccion_id); ?>" target="_blank" title="Acta en PDF">
                <i class="bi bi-file-earmark-pdf-fill"></i>
              </a>
              <button type="button" class="btn btn-danger" title="Eliminar" data-url="<?= base_url(EXPEDIENTES_PATH . '/eliminar/' . $expediente->id_expediente) ?>" data-name="<?= $expediente->id_expediente; ?>" onclick="eliminar(this)">
                <i class="bi bi-trash-fill"></i>
              </button>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>