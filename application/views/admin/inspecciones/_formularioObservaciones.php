<div class="card">
  <div class="card-body">
    <h5>Observaciones</h5>

    <div>
      <label for="observaciones" class="form-label mb-0">Observaciones</label>
      <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Ingrese alguna observación" rows="6"><?= isset($inspeccion) ? $inspeccion->observaciones : ''; ?></textarea>
    </div>
  </div>
</div>