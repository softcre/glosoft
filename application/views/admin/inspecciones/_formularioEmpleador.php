<!-- La idea es que esto actue como un visor
 cuando ingrese el cuit va a buscar en la tabla de empleadores
  - si esta lo carga
  - sino levanta el formulario para dar de alta al empleador

El boton Agregar carga el form de empleador / obviamente si estando en el form tambien deberia validar el cuit que no exita para dar de alta. Luego cuando se guarde deberia cargarlo aqui.

PD: sacar "!" de los isset una vez que el get traiga datos del empleador
-->
<input type="hidden" name="empleador_id" value="<?= !isset($inspeccion) ? $inspeccion->empleador_id : ''; ?>">
<div class="row">
  <div class="col-md-4 mb-2">
    <label for="empleador_cuit" class="form-label mb-0">CUIT</label>
    <input type="text" class="form-control" id="empleador_cuit" name="empleador_cuit" placeholder="Ingrese el cuit" value="<?= !isset($inspeccion) ? $inspeccion->cuit : ''; ?>">
  </div>

  <div class="col-md-4 mb-2">
    <label for="empleador_razon_social" class="form-label mb-0">Razón social</label>
    <input type="text" class="form-control" id="empleador_razon_social" name="empleador_razon_social" value="<?= !isset($inspeccion) ? $inspeccion->razon_social : ''; ?>" readonly>
  </div>

  <div class="col-md-2 mb-2">
    <button type="button" class="btn btn-primary">Agregar</button>
  </div>
</div>