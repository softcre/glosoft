<div class="mb-3">
  <label for="ubicacion" class="form-label mb-0" title="Obligatorio">Ubicación <span class="text-danger" title="Obligatorio">*</span></label>
  <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingrese la ubicación" value="<?= isset($expediente) ? $expediente->ubicacion : ''; ?>">
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