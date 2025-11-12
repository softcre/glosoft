<div class="table-responsive">
  <table id="tblInspecciones" class="table table-sm table-hover">
    <thead class="table-success">
      <tr>
        <th scope="col" class="text-center">N° acta</th>
        <th scope="col" class="text-center">Ubicación</th>
        <th scope="col" class="text-center">Fecha</th>
        <th scope="col" class="text-center">Estado</th>
        <th scope="col" class="text-center"></th>
      </tr>
    </thead>
    <tbody class="align-middle text-center">
      <?php foreach ($inspecciones as $inspeccion): ?>
        <tr>
          <td><?= $inspeccion->id_inspeccion; ?></td>
          <td><?= formatearFecha($inspeccion->fecha_inspeccion); ?></td>
          <td><?= $inspeccion->ubicacion; ?></td>
          <td>
            <span class="badge <?= colorEstadoInspeccion($inspeccion->nombre_estado); ?>"><?= $inspeccion->nombre_estado; ?></span>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              <button type="button" class="btn btn-info" title="Ver inspeccion" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(INSPECCIONES_PATH . '/frmVer/' . $inspeccion->id_inspeccion) ?>">
                <i class="bi bi-eye"></i>
              </button>
              <a href="<?= base_url(INSPECCIONES_PATH . '/edicion/' . $inspeccion->id_inspeccion) ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
              <button type="button" class="btn btn-danger" title="Eliminar" data-url="<?= base_url(INSPECCIONES_PATH . '/eliminar/' . $inspeccion->id_inspeccion) ?>" data-name="<?= $inspeccion->id_inspeccion; ?>" onclick="eliminar(this)">
                <i class="bi bi-trash-fill"></i>
              </button>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>