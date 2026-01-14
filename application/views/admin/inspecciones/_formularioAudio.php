<div class="card">
  <div id="collapseAudio" class="card-body"
    data-audio-upload-url="<?= base_url('inspecciones/guardarAudio') ?>"
    data-audio-list-url="<?= base_url('inspecciones/getAudios/' . $inspeccion_id) ?>">
    <h5>Audio</h5>

    <div class="d-flex align-items-end justify-content-between gap-3 mb-3">
      <div class="flex-grow-1">
        <label for="audioTitulo"
          class="form-label small text-muted mb-1">
          Título del audio <span class="text-danger">*</span>
        </label>

        <input type="text"
          id="audioTitulo"
          class="form-control form-control-sm"
          maxlength="150"
          placeholder="Título del audio (obligatorio)">

        <div class="invalid-feedback">
          Ingrese un título para identificar este audio.
        </div>
      </div>

      <div class="d-flex flex-column gap-2">
        <div class="btn-group" role="group">
          <button type="button"
            class="btn btn-danger"
            id="btnStartAudio"
            title="Iniciar grabación">
            <i class="bi bi-record-circle fs-5"></i>
          </button>

          <button type="button"
            class="btn btn-warning"
            id="btnStopAudio"
            title="Detener grabación"
            disabled>
            <i class="bi bi-stop-circle fs-5"></i>
          </button>
        </div>

        <div class="btn-group" role="group">
          <button type="button"
            class="btn btn-primary"
            id="btnUploadAudio"
            data-upload-url="<?= base_url(INSPECCIONES_PATH . '/guardarAudio'); ?>"
            title="Subir grabación"
            disabled>
            <i class="bi bi-cloud-upload fs-5"></i>
          </button>

          <button type="button"
            class="btn btn-secondary"
            id="btnClearAudio"
            title="Limpiar grabación">
            <i class="bi bi-x-circle fs-5"></i>
          </button>
        </div>
      </div>
    </div>

    <audio id="audioPreview"
      controls
      class="w-100 d-none mb-3"></audio>

    <input type="hidden" id="audioBlobData">

    <div id="div_tblAudios"
      class="mt-4"
      data-url="<?= base_url(INSPECCIONES_PATH . '/getAudios/' . $inspeccion_id); ?>">
    </div>
  </div>
</div>