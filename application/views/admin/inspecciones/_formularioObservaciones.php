<div class="row">
  <div class="col-md-12 mb-2">
    <label for="observaciones" class="form-label mb-0">Observaciones</label>
    <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Ingrese alguna observación" rows="3"><?= isset($inspeccion) ? $inspeccion->observaciones : ''; ?></textarea>
  </div>
</div>
