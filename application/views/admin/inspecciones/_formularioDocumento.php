<div class="card">
  <div id="collapseDocs" class="card-body"
    data-doc-upload-url="<?= base_url(INSPECCIONES_PATH . '/guardarDocumento') ?>"
    data-doc-list-url="<?= base_url(INSPECCIONES_PATH . '/listarDocumentos/' . $inspeccion_id) ?>">
    <h5>Documentación</h5>

    <div class="card p-3 shadow-sm mb-3" style="max-width:620px;">
      <label class="form-label small text-muted">
        Tipo de documento <span class="text-danger">*</span>
      </label>

      <select id="docTipo" class="form-select form-select-sm mb-2">
        <option value="">Seleccione</option>
        <option value="Libreta del Trabajador Rural">Libreta del Trabajador Rural</option>
        <option value="Recibos de sueldo">Recibos de sueldo</option>
        <option value="Documentación de seguridad social">Documentación de seguridad social</option>
        <option value="Constancia de ART">Constancia de ART</option>
        <option value="Constancia AFIP">Constancia de inscripción a la AFIP</option>
        <option value="Nómina de empleados">Nómina de empleados</option>
        <option value="Registros de horas trabajadas">Registros de horas trabajadas</option>
        <option value="Contrato de trabajo">Contrato de trabajo</option>
      </select>

      <div class="mt-2">
        <label class="form-label small text-muted">Archivo</label>
        <input type="file" id="docFile" class="form-control form-control-sm">
      </div>

      <div class="text-end mt-3">
        <button class="btn btn-primary btn-sm" id="btnUploadDoc">
          <i class="bi bi-cloud-upload"></i> Subir documento
        </button>
      </div>
    </div>

    <div id="div_tblDocumentos"
      class="mt-4"
      data-url="<?= base_url(INSPECCIONES_PATH . '/getDocumentos/' . $inspeccion_id) ?>">
    </div>
  </div>
</div>