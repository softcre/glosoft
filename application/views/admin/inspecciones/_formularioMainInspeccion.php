<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button
        class="accordion-button"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseOne"
        aria-expanded="true"
        aria-controls="collapseOne">
        Datos del empleador / Titular
      </button>
    </h2>
    <div
      id="collapseOne"
      class="accordion-collapse collapse show">
      <div class="accordion-body">
        <?php $this->load->view('admin/inspecciones/_formularioEmpleador'); ?>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button
        class="accordion-button"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseTwo"
        aria-expanded="false"
        aria-controls="collapseTwo">
        Datos del establecimiento
      </button>
    </h2>
    <div
      id="collapseTwo"
      class="accordion-collapse collapse show">
      <div class="accordion-body">
        <?php $this->load->view('admin/inspecciones/_formularioEstablecimiento'); ?>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button
        class="accordion-button"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseThree"
        aria-expanded="false"
        aria-controls="collapseThree">
        Datos del personal
      </button>
    </h2>
    <div
      id="collapseThree"
      class="accordion-collapse collapse show">
      <div class="accordion-body">
        <?php $this->load->view('admin/inspecciones/_formularioTrabajadores');?>
      </div>
    </div>
  </div>

<!-- audio -->

 <div class="accordion-item">
    <h2 class="accordion-header" id="headingAudio">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseAudio"
                aria-expanded="true"
                aria-controls="collapseAudio">
            Registro y Gestión de Audios
        </button>
    </h2>

    <div id="collapseAudio"
         class="accordion-collapse collapse show"
         data-audio-upload-url="<?= base_url('inspecciones/guardarAudio') ?>"
         data-audio-list-url="<?= base_url('inspecciones/getAudios/' . $inspeccion_id) ?>">

        <div class="accordion-body">

            <!-- Title + Buttons Horizontal Layout -->
            <div class="card shadow-sm mb-3 p-3" style="max-width:620px;">

                <div class="d-flex align-items-end justify-content-between gap-3">

                    <!-- Title Field (left) -->
                    <div class="flex-grow-1">

                        <label for="audioTitulo"
                               class="form-label small text-muted mb-1">
                            Título del audio <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="audioTitulo"
                               class="form-control form-control-sm"
                               maxlength="150"
                               placeholder="Título del audio (obligatorio)"
                               required>

                        <div class="invalid-feedback">
                            Ingrese un título para identificar este audio.
                        </div>

                    </div>

                    <!-- Buttons (right) -->
                    <div class="d-flex flex-column gap-2">

                        <!-- Record / Stop -->
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

                        <!-- Upload / Clear -->
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
            </div>

            <!-- Audio Preview -->
            <audio id="audioPreview"
                   controls
                   class="w-100 d-none mb-3"></audio>

            <input type="hidden" id="audioBlobData">

            <!-- Table contents -->
            <div id="div_tblAudios"
                 class="mt-4"
                 data-url="<?= base_url(INSPECCIONES_PATH . '/getAudios/' . $inspeccion_id); ?>">
            </div>

        </div>
    </div>
</div>


  <!-- fin audio -->

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button
        class="accordion-button"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapseFour"
        aria-expanded="false"
        aria-controls="collapseFour">
        Observaciones
      </button>
    </h2>
    <div
      id="collapseFour"
      class="accordion-collapse collapse show">
      <div class="accordion-body">
        <?php $this->load->view('admin/inspecciones/_formularioObservaciones');?>
      </div>
    </div>
  </div>
</div>