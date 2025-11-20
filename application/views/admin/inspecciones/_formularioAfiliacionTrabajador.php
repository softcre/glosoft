<?php
if (isset($trabajador) && $trabajador->estado_al_inspeccionar == 'AFILIADO') {
  $disabled = 'disabled';
} else {
  $disabled = '';
}
?>

<input type="hidden" name="inspeccion_id" value="<?= $inspeccion_id; ?>">
<input type="hidden" name="afiliacion_id" value="<?= isset($afiliacion) ? $afiliacion->id_afiliacion : ''; ?>">
<input type="hidden" name="estado_al_inspeccionar" value="<?= isset($trabajador) ? $trabajador->estado_al_inspeccionar : ''; ?>">
<input type="hidden" name="trabajador_encontrado_id" value="<?= isset($trabajador) ? $trabajador->id_trabajador_encontrado : ''; ?>">

<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button
        class="accordion-button"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseUno"
        aria-expanded="true"
        aria-controls="collapseUno">
        Datos de Afiliación
      </button>
    </h2>
    <div
      id="collapseUno"
      class="accordion-collapse collapse show">
      <div class="accordion-body">
        <div class="row">
          <div class="col-md-4 mb-2">
            <label for="tipo_doc" class="form-label mb-0" title="Obligatorio">Tipo de doc. <span class="text-danger" title="Obligatorio">*</span></label>
            <select class="form-select" id="tipo_doc" name="tipo_doc" <?= $disabled ?>>
              <?php $valor_tipo = isset($trabajador) ? $trabajador->tipo_doc : null; ?>
              <option value="DNI" <?= ($valor_tipo == 'DNI') ? 'selected' : '' ?>>DNI</option>
              <option value="PAS" <?= ($valor_tipo == 'PAS') ? 'selected' : '' ?>>Pasaporte</option>
              <option value="LC" <?= ($valor_tipo == 'LC') ? 'selected' : '' ?>>Libreta Cívica</option>
              <option value="LE" <?= ($valor_tipo == 'LE') ? 'selected' : '' ?>>Libreta de Enrolamiento</option>
            </select>
          </div>

          <div class="col-md-4 mb-2">
            <label for="nro_doc" class="form-label mb-0" title="Obligatorio">Nro documento <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="number" class="form-control bg-light" id="nro_doc" name="nro_doc" placeholder="Ingrese nro de documento" value="<?= isset($afiliacion) ? $afiliacion->nro_doc : $dni; ?>" readonly>
          </div>

          <div class="col-md-4 mb-2">
            <label for="cuil" class="form-label mb-0">CUIL</label>
            <input type="text" class="form-control" id="cuil" name="cuil" placeholder="Ingrese cuil" value="<?= isset($afiliacion) ? $afiliacion->cuil : ''; ?>" <?= $disabled ?>>
          </div>

          <div class="col-md-4 mb-2">
            <label for="apellido" class="form-label mb-0" title="Obligatorio">Apellido <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese el apellido" value="<?= isset($afiliacion) ? $afiliacion->apellido : ''; ?>" <?= $disabled ?>>
          </div>

          <div class="col-md-4 mb-2">
            <label for="nombre" class="form-label mb-0" title="Obligatorio">Nombre <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" value="<?= isset($afiliacion) ? $afiliacion->nombre : ''; ?>" <?= $disabled ?>>
          </div>

          <div class="col-md-4 mb-2">
            <label for="fecha_nacimiento" class="form-label mb-0" title="Obligatorio">Fecha de Nacimiento <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Ingrese fecha de ingreso" value="<?= isset($afiliacion) ? $afiliacion->fecha_nacimiento : ''; ?>" <?= $disabled ?>>
          </div>

          <div class="col-md-4 mb-2">
            <label for="actividad" class="form-label mb-0" title="Obligatorio">Actividad <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="text" class="form-control" id="actividad" name="actividad" placeholder="Ingrese actividad" value="<?= isset($afiliacion) ? $afiliacion->actividad : ''; ?>" <?= $disabled ?>>
          </div>

          <div class="col-md-4 mb-2">
            <label for="nacionalidad" class="form-label mb-0">Nacionalidad</label>
            <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Ingrese la nacionalidad" value="<?= isset($afiliacion) ? $afiliacion->nacionalidad : ''; ?>" <?= $disabled ?>>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button
        class="accordion-button"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseDos"
        aria-expanded="false"
        aria-controls="collapseDos">
        Datos del Trabajador
      </button>
    </h2>
    <div
      id="collapseDos"
      class="accordion-collapse collapse show">
      <div class="accordion-body">
        <!-- Datos de Empleo -->
        <div class="row">
          <div class="col-md-4 mb-2">
            <label for="fecha_ingreso" class="form-label mb-0" title="Obligatorio">Fecha de Ingreso <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="Ingrese fecha de ingreso" value="<?= isset($trabajador) ? $trabajador->fecha_ingreso : ''; ?>">
          </div>

          <div class="col-md-4 mb-2">
            <label for="cargo" class="form-label mb-0" title="Obligatorio">Cargo y/o tareas <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Ingrese cargo" value="<?= isset($trabajador) ? $trabajador->cargo : ''; ?>">
          </div>

          <div class="col-md-4 mb-2">
            <label for="remuneracion" class="form-label mb-0" title="Obligatorio">Ult. Sueldo <span class="text-danger" title="Obligatorio">*</span></label>
            <input type="text" class="form-control" id="remuneracion" name="remuneracion" placeholder="Ingrese el monto último sueldo" value="<?= isset($trabajador) ? $trabajador->remuneracion : ''; ?>">
          </div>

          <div class="col-md-4 mb-2">
            <label for="alojado_en_predio" class="form-label mb-0" title="Obligatorio">Vive en establecimiento <span class="text-danger" title="Obligatorio">*</span></label>
            <select class="form-select" id="alojado_en_predio" name="alojado_en_predio">
              <?php $valor_guardado = isset($trabajador) ? $trabajador->alojado_en_predio : null; ?>
              <option value="1" <?= ($valor_guardado == '1') ? 'selected' : ''; ?>>SI</option>
              <option value="0" <?= ($valor_guardado == '0') ? 'selected' : ''; ?>>NO</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>