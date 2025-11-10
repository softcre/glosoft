<div class="table-responsive">
  <table id="tblInspecciones" class="table table-sm table-hover">
    <thead class="table-success">
      <tr>
        <th scope="col" class="text-center">N° Acta</th>
        <th scope="col" class="text-center">Ubicación</th>
        <th scope="col" class="text-center">Inspector asignado</th>
        <th scope="col" class="text-center">Estado</th>
        <th scope="col" class="text-center"></th>
      </tr>
    </thead>
    <tbody class="align-middle text-center">
      <?php foreach ($inspecciones as $inspeccion): ?>
        <tr>
          <td><?= $inspeccion->numero_acta; ?></td>
          <td><?= $inspeccion->ubicacion; ?></td>
          <td><?= concatenar($inspeccion->inspector_apellido, $inspeccion->inspector_nombre); ?></td>
          <td>
            <span class="badge <?= colorEstadoInspeccion($inspeccion->nombre_estado); ?>"><?= $inspeccion->nombre_estado; ?></span>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              <button type="button" class="btn btn-info" title="Ver inspección" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(INSPECCIONES_PATH . '/frmVer/' . $inspeccion->id_inspeccion) ?>">
                <i class="bi bi-eye"></i>
              </button>
              <button type="button" class="btn btn-warning" title="Editar" data-bs-toggle="modal" data-bs-target="#small" data-url="<?= base_url(INSPECCIONES_PATH . '/frmEditar/' . $inspeccion->id_inspeccion) ?>">
                <i class="bi bi-pencil"></i>
              </button>
              <!-- <button type="button" class="btn btn-danger" title="Eliminar"><i class="bi bi-trash-fill"></i></button> -->
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>