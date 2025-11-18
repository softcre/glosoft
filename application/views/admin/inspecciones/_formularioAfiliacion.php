<input type="hidden" name="inspeccion_id" value="<?= $inspeccion_id; ?>?>">
<div class="row">
  <div class="col-md-4 mb-2">
    <label for="apellido" class="form-label mb-0" title="Obligatorio">Apellido <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese el apellido">
  </div>

  <div class="col-md-4 mb-2">
    <label for="nombre" class="form-label mb-0" title="Obligatorio">Nombre <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre">
  </div>

  <div class="col-md-4 mb-2">
    <label for="tipo_doc" class="form-label mb-0" title="Obligatorio">Tipo de doc. <span class="text-danger" title="Obligatorio">*</span></label>
    <select class="form-select" id="tipo_doc" name="tipo_doc">
      <option value="DNI" selected>DNI</option>
      <option value="PAS">Pasaporte</option>
      <option value="LC">Libreta Cívica</option>
      <option value="LE">Libreta de Enrolamiento</option>
    </select>
  </div>

  <div class="col-md-4 mb-2">
    <label for="nro_doc" class="form-label mb-0" title="Obligatorio">Nro documento <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="number" class="form-control" id="nro_doc" name="nro_doc" placeholder="Ingrese nro de documento">
  </div>

  <div class="col-md-4 mb-2">
    <label for="cuil" class="form-label mb-0">CUIL</label>
    <input type="text" class="form-control" id="cuil" name="cuil" placeholder="Ingrese cuil">
  </div>

  <div class="col-md-4 mb-2">
    <label for="fecha_solicitud" class="form-label mb-0" title="Obligatorio">Fecha de Ingreso <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" placeholder="Ingrese fecha de ingreso">
  </div>

  <div class="col-md-4 mb-2">
    <label for="actividad" class="form-label mb-0" title="Obligatorio">Actividad <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="text" class="form-control" id="actividad" name="actividad" placeholder="Ingrese actividad">
  </div>

  <div class="col-md-4 mb-2">
    <label for="nacionalidad" class="form-label mb-0">Nacionalidad</label>
    <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Ingrese la nacionalidad">
  </div>
</div>

<!-- Datos de Empleo -->
<div class="row">
  <div class="col-md-4 mb-2">
    <label for="fecha_ingreso" class="form-label mb-0" title="Obligatorio">Fecha de Ingreso <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="Ingrese fecha de ingreso">
  </div>

  <div class="col-md-4 mb-2">
    <label for="cargo" class="form-label mb-0" title="Obligatorio">Cargo y/o tareas <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Ingrese cargo">
  </div>

  <div class="col-md-4 mb-2">
    <label for="monto_ult_sueldo" class="form-label mb-0" title="Obligatorio">Ult. Sueldo <span class="text-danger" title="Obligatorio">*</span></label>
    <input type="text" class="form-control" id="monto_ult_sueldo" name="monto_ult_sueldo" placeholder="Ingrese el monto último sueldo">
  </div>

  <div class="col-md-4 mb-2">
    <label for="vive_establecimiento" class="form-label mb-0" title="Obligatorio">Vive en establecimiento <span class="text-danger" title="Obligatorio">*</span></label>
    <select class="form-select" id="vive_establecimiento" name="vive_establecimiento">
      <option value="SI" selected>SI</option>
      <option value="NO">NO</option>
    </select>
  </div>
</div>