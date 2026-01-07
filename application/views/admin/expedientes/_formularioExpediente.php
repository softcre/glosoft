<div class="mb-3">
  <label for="ubicacion" class="form-label mb-0" title="Obligatorio">Ubicación <span class="text-danger" title="Obligatorio">*</span></label>
  <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingrese la ubicación" value="<?= isset($expediente) ? $expediente->ubicacion : ''; ?>">
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="provincia" class="form-label mb-0">Provincia</label>
    <select class="form-select" id="provincia" name="provincia_id">
      <option value="">Seleccione una provincia</option>
      <?php foreach ($provincias as $prov) : ?>
        <?php $s = (isset($expediente)) ? (($expediente->provincia_id == $prov->id_provincia) ? 'selected' : '') : ''; ?>
        <option value="<?= $prov->id_provincia; ?>" <?= $s ?>>
          <?= $prov->nombre; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-6 mb-3">
    <label for="localidad" class="form-label mb-0">Localidad</label>
    <select class="form-select" id="localidad" name="localidad_id" <?= (!isset($expediente) || !$expediente->provincia_id) ? 'disabled' : ''; ?>>
      <option value="">Seleccione una localidad</option>
      <?php if (isset($localidades) && is_array($localidades)) : ?>
        <?php foreach ($localidades as $loc) : ?>
          <?php $s = (isset($expediente)) ? (($expediente->localidad_id == $loc->id_localidad) ? 'selected' : '') : ''; ?>
          <option value="<?= $loc->id_localidad; ?>" <?= $s ?>>
            <?= $loc->nombre; ?>
          </option>
        <?php endforeach; ?>
      <?php endif; ?>
    </select>
  </div>
</div>

<div class="mb-3">
  <label for="inspector" class="form-label mb-0" title="Obligatorio">Inspector <span class="text-danger" title="Obligatorio">*</span></label>
  <select class="form-select" id="inspector" name="inspector_id">
    <option value="" disabled selected>Seleccione un inspector</option>
    <?php foreach ($inspectores as $ins) : ?>
      <?php $s = (isset($expediente)) ? (($expediente->inspector_id == $ins->id_usuario) ? 'selected' : '') : ''; ?>
      <option value="<?= $ins->id_usuario; ?>" <?= $s ?>>
        <?= concatenar($ins->apellido, $ins->nombre); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="text-center">
  <small class="text-muted"><span class="text-danger" title="Obligatorio">*</span> Campos obligatorios</small>
</div>