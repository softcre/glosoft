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
          <td><?= $inspeccion->ubicacion; ?></td>
          <td><?= formatearFecha($inspeccion->fecha_inspeccion); ?></td>
          <td>
            <span class="badge <?= colorEstadoInspeccion($inspeccion->nombre_estado); ?>"><?= $inspeccion->nombre_estado; ?></span>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              <button type="button" class="btn btn-info" title="Ver inspeccion" data-bs-toggle="modal" data-bs-target="#extra-large" data-url="<?= base_url(INSPECCIONES_PATH . '/frmVer/' . $inspeccion->id_inspeccion . '/' . $inspeccion->id_expediente) ?>">
                <i class="bi bi-eye"></i>
              </button>
              <?php if ($inspeccion->nombre_estado == 'INSPECCION') : ?>
                <a href="<?= base_url(INSPECCIONES_PATH . '/edicion/' . $inspeccion->id_inspeccion . '/' . $inspeccion->id_expediente) ?>" class="btn btn-warning"><i class="bi bi-pencil" title="Editar"></i></a>
              <?php endif; ?>
              <a class="btn btn-outline-danger btn-sm" href="<?= base_url(INSPECCIONES_PATH . '/pdf_ver/' . $inspeccion->id_inspeccion); ?>" target="_blank" title="Acta en PDF">
                <i class="bi bi-file-earmark-pdf-fill"></i>
              </a>
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