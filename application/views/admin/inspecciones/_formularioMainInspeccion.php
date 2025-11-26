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

            <!-- Recorder Buttons -->
            <div class="btn-group mb-3" role="group">
                <button type="button" class="btn btn-success" id="btnStartAudio">
                    Iniciar grabación
                </button>

                <button type="button" class="btn btn-warning" id="btnStopAudio" disabled>
                    Detener
                </button>

                <button type="button"
                        class="btn btn-info"
                        id="btnUploadAudio"
                        data-upload-url="<?= base_url(INSPECCIONES_PATH . '/guardarAudio'); ?>"
                        disabled>
                    Subir grabación
                </button>
            </div>

            <!-- Audio Preview -->
            <audio id="audioPreview" controls class="w-100 d-none"></audio>

            <input type="hidden" id="audioBlobData">

            <!-- Audios table container -->
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