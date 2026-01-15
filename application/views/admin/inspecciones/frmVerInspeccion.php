<div class="modal-header text-bg-success py-2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h5 class="modal-title" id="modalInspeccionLabel">
          Detalle de Inspección #<?= $inspeccion->id_inspeccion; ?>
        </h5>
      </div>

      <div class="col-md-6 text-end">
        <span class="d-block fw-bold">Acta Nro: <span id="acta_nro_visualizacion">
            <?= $inspeccion->id_inspeccion; ?>
          </span></span>
        <span class="d-block">Fecha: <span id="fecha_inspeccion_visualizacion">
            <?= isset($inspeccion) ? formatearFecha($inspeccion->fecha_inspeccion) : 'N/A'; ?>
          </span></span>
      </div>
    </div>
  </div>
  <button type="button" id="cerrarModal" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <?php if (!permisoInspector() && $total_personal_sin_afiliar > 0): ?>
    <div class="alert alert-danger">
      Esta inspección contiene <?= $total_personal_sin_afiliar; ?> trabajadores sin afiliar !!!
    </div>
  <?php endif; ?>

  <ul class="nav nav-tabs" id="tabInspeccion" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="generales-tab" data-bs-toggle="tab" data-bs-target="#generales-pane" type="button" role="tab" aria-controls="generales-pane" aria-selected="true">
        ✅ Datos Generales
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal-pane" type="button" role="tab" aria-controls="personal-pane" aria-selected="false">
        👥 Personal
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="observaciones-tab" data-bs-toggle="tab" data-bs-target="#observaciones-pane" type="button" role="tab" aria-controls="observaciones-pane" aria-selected="false">
        ✍️ Observaciones
      </button>
    </li>
  </ul>

  <div class="tab-content border border-top-0 p-3 bg-white rounded-bottom" id="tabInspeccionContent">

    <div class="tab-pane fade show active" id="generales-pane" role="tabpanel" aria-labelledby="generales-tab" tabindex="0">
      <h4 class="mb-3 border-bottom pb-1 text-primary">Información del Empleador</h4>
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">CUIT</label>
          <p class="form-control-plaintext fw-bold p-0" id="cuit_visualizacion"><?= isset($empleador) ? $empleador->cuit : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Razón Social</label>
          <p class="form-control-plaintext p-0" id="razon_social_visualizacion"><?= isset($empleador) ? $empleador->razon_social : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Responsable a cargo</label>
          <p class="form-control-plaintext p-0" id="responsable_nombre_visualizacion"><?= isset($empleador) ? $empleador->responsable_nombre : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Teléfono</label>
          <p class="form-control-plaintext p-0" id="telefono_visualizacion"><?= isset($empleador) ? $empleador->telefono : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Domicilio</label>
          <p class="form-control-plaintext p-0" id="domicilio_visualizacion"><?= isset($empleador) ? $empleador->domicilio : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Localidad</label>
          <p class="form-control-plaintext p-0" id="localidad_visualizacion"><?= isset($empleador) ? $empleador->localidad : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Provincia</label>
          <p class="form-control-plaintext p-0" id="provincia_visualizacion"><?= isset($empleador) ? $empleador->provincia : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Actividad</label>
          <p class="form-control-plaintext p-0" id="actividad_visualizacion"><?= isset($empleador) ? $empleador->actividad : ''; ?></p>
        </div>
      </div>

      <hr class="my-4">

      <h4 class="mb-3 border-bottom pb-1 text-primary">Información del Establecimiento</h4>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label text-muted mb-0">Nombre del establecimiento</label>
          <p class="form-control-plaintext p-0"><?= isset($inspeccion) ? $inspeccion->establecimiento_nombre : ''; ?></p>
        </div>
        <div class="col-md-6">
          <label class="form-label text-muted mb-0">Actividad Principal</label>
          <p class="form-control-plaintext p-0"><?= isset($inspeccion) ? $inspeccion->actividad_principal : ''; ?></p>
        </div>
        <div class="col-md-8">
          <label class="form-label text-muted mb-0">Ubicación</label>
          <p class="form-control-plaintext p-0"><?= isset($inspeccion) ? $inspeccion->ubicacion : ''; ?></p>
        </div>
        <div class="col-md-4">
          <label class="form-label text-muted mb-0">Superficie (ha)</label>
          <p class="form-control-plaintext p-0"><?= isset($inspeccion) ? $inspeccion->superficie_ha : ''; ?></p>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="personal-pane" role="tabpanel" aria-labelledby="personal-tab" tabindex="0">
      <h4 class="mb-3 border-bottom pb-1">Trabajadores Registrados (<?= count($trabajadores); ?>)</h4>
      <div class="table-responsive">
        <table id="tblTrabajadoresVisualizacion" class="table table-sm table-striped">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-center">Nombre y Apellido</th>
              <th scope="col" class="text-center">DNI</th>
              <th scope="col" class="text-center">Fecha Ingreso</th>
              <th scope="col" class="text-center">Cargo</th>
              <th scope="col" class="text-center">Ult. Sueldo</th>
              <th scope="col" class="text-center">Vive en Estab.</th>
              <th scope="col" class="text-center">Afiliado</th>
            </tr>
          </thead>
          <tbody class="align-middle text-center">
            <?php if (!empty($trabajadores)): ?>
              <?php foreach ($trabajadores as $trabajador): ?>
                <tr>
                  <td class="text-start"><?= concatenar($trabajador->apellido, $trabajador->nombre); ?></td>
                  <td><?= $trabajador->nro_doc; ?></td>
                  <td><?= formatearFecha($trabajador->fecha_ingreso); ?></td>
                  <td><?= $trabajador->cargo; ?></td>
                  <td class="text-end fw-bold"><?= formatearPrecio($trabajador->remuneracion); ?></td>
                  <td>
                    <span class="badge <?= $trabajador->alojado_en_predio ? 'text-bg-success' : 'text-bg-secondary' ?>">
                      <?= $trabajador->alojado_en_predio ? 'SI' : 'NO' ?>
                    </span>
                  </td>
                  <td>
                    <span class="badge <?= ($trabajador->estado_al_inspeccionar == 'AFILIADO') ? 'text-bg-success' : 'text-bg-danger' ?>">
                      <?= ($trabajador->estado_al_inspeccionar == 'AFILIADO') ? 'SI' : 'NO' ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">No se registraron trabajadores en esta inspección.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="row mt-3">
        <div class="col-md-6">
          <label class="form-label text-muted m-0">Cantidad Personal Permanentes</label>
          <p class="fw-bold p-0"><?= $inspeccion->cantidad_personal_perm; ?></p>
        </div>
        <div class="col-md-6">
          <label class="form-label text-muted m-0">Cantidad Personal Transitorios</label>
          <p class="fw-bold p-0"><?= $inspeccion->cantidad_personal_trans; ?></p>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="observaciones-pane" role="tabpanel" aria-labelledby="observaciones-tab" tabindex="0">
      <h4 class="mb-3 border-bottom pb-1 text-primary">Observaciones de la Inspección</h4>
      <div class="row">
        <div class="col-12">
          <label class="form-label text-muted">Notas y Detalle</label>
          <div class="p-3 bg-light border rounded" style="min-height: 100px; white-space: pre-wrap;">
            <?= $inspeccion->observaciones ? htmlspecialchars($inspeccion->observaciones) : 'No se registraron observaciones adicionales.'; ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php if (!permisoInspector()): ?>
    <div class="mt-2 text-end">
      <small>Inspector a cargo: <b><?= concatenar($inspeccion->inspector_apellido, $inspeccion->inspector_nombre); ?></b></small>
    </div>
  <?php endif; ?>
</div>

<div class="modal-footer bg-light mt-0 py-1">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
    <i class="bi bi-x-circle me-1"></i>Cerrar
  </button>

  <?php if (permisoVerificador() && $inspeccion->nombre_estado == 'VERIFICACION') : ?>
    <?php if ($total_personal_sin_afiliar > 0) : ?>
      <form id="form_changeEstado" name="Estado" method="post" action="<?= base_url(INSPECCIONES_PATH . '/changeEstado'); ?>" onsubmit="altaUpdate(event)">
        <input type="hidden" name="id_expediente" value="<?= $id_expediente; ?>">
        <input type="hidden" name="estado_inpeccion" value="3">
        <button type="submit" id="btnFormEstado" class="btn btn-success" name="button">
          <div class="d-none">
            <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
            Pasando a liquidación...
          </div>
          <span><i class="bi bi-floppy2-fill me-1"></i>Pasar a Liquidación</span>
        </button>
      </form>
    <?php else: ?>
      <form id="form_changeEstado" name="Estado" method="post" action="<?= base_url(INSPECCIONES_PATH . '/changeEstado'); ?>" onsubmit="altaUpdate(event)">
        <input type="hidden" name="id_expediente" value="<?= $id_expediente; ?>">
        <input type="hidden" name="estado_inpeccion" value="4">
        <button type="submit" id="btnFormEstado" class="btn btn-success" name="button">
          <div class="d-none">
            <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
            Finalizando inspección...
          </div>
          <span><i class="bi bi-floppy2-fill me-1"></i>Finalizar inspección</span>
        </button>
      </form>
    <?php endif; ?>
  <?php endif; ?>
</div>