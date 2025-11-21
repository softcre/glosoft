<div class="row">
  <div class="col-md-6 mb-2">
    <label for="establecimiento_nombre" class="form-label mb-0">Nombre del establecimiento</label>
    <input type="text" class="form-control" id="establecimiento_nombre" name="establecimiento_nombre" placeholder="Ingrese el nombre del establecimiento" value="<?= isset($inspeccion) ? $inspeccion->establecimiento_nombre : ''; ?>">
  </div>

  <div class="col-md-6 mb-2">
    <label for="actividad_principal" class="form-label mb-0">Actividad principal</label>
    <input type="text" class="form-control" id="actividad_principal" name="actividad_principal" placeholder="Ingrese la actividad principal" value="<?= isset($inspeccion) ? $inspeccion->actividad_principal : ''; ?>">
  </div>
</div>

<div class="row">
  <div class="col-md-8 mb-2">
    <label for="ubicacion" class="form-label mb-0">Ubicación</label>
    <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ingrese la ubicación" value="<?= isset($inspeccion) ? $inspeccion->ubicacion : ''; ?>">
  </div>

  <div class="col-md-4 mb-2">
    <label for="superficie_ha" class="form-label mb-0">Superficie (ha)</label>
    <input type="number" step="0.01" class="form-control" id="superficie_ha" name="superficie_ha" placeholder="Ingrese la cantidad de hectareas" value="<?= isset($inspeccion) ? $inspeccion->superficie_ha : ''; ?>">
  </div>
</div>