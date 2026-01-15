<div class="d-flex flex-column" style="height: 70vh; overflow: hidden;">

  <div class="bg-white border-bottom flex-shrink-0">
    <ul class="nav nav-tabs px-3" id="form-tabs" style="border-bottom: none;">
      <li class="nav-item"><a class="nav-link active" href="#section-empleador">Empleador</a></li>
      <li class="nav-item"><a class="nav-link" href="#section-establecimiento">Establecimiento</a></li>
      <li class="nav-item"><a class="nav-link" href="#section-personal">Personal</a></li>
      <li class="nav-item"><a class="nav-link" href="#section-audio">Audio</a></li>
      <li class="nav-item"><a class="nav-link" href="#section-documento">Documento</a></li>
      <li class="nav-item"><a class="nav-link" href="#section-observacion">Observaciones</a></li>
    </ul>
  </div>

  <div id="content-scroll-area" class="flex-grow-1 p-4" style="overflow-y: auto; position: relative;">

    <section id="section-empleador" class="content-section mb-3 border-bottom pb-3">
      <?php $this->load->view('admin/inspecciones/_formularioEmpleador'); ?>
    </section>

    <section id="section-establecimiento" class="content-section mb-3 border-bottom pb-3">
      <?php $this->load->view('admin/inspecciones/_formularioEstablecimiento'); ?>
    </section>

    <section id="section-personal" class="content-section mb-3 border-bottom pb-3">
      <?php $this->load->view('admin/inspecciones/_formularioTrabajadores'); ?>
    </section>

    <section id="section-audio" class="content-section mb-3 border-bottom pb-3">
      <?php $this->load->view('admin/inspecciones/_formularioAudio'); ?>
    </section>

    <section id="section-documento" class="content-section mb-3 border-bottom pb-3">
      <?php $this->load->view('admin/inspecciones/_formularioDocumento'); ?>
    </section>

    <section id="section-observacion" class="content-section mb-3 border-bottom pb-3">
      <?php $this->load->view('admin/inspecciones/_formularioObservaciones'); ?>
    </section>

    <div style="min-height: 30vh;"></div>
  </div>
</div>

<script>
  // Inicialización manual para asegurar el funcionamiento en contenedores con scroll propio
  // document.addEventListener('DOMContentLoaded', function () {
  //   var scrollSpyContent = document.getElementById('content-scroll-area');
  //   var spy = new bootstrap.ScrollSpy(scrollSpyContent, {
  //     target: '#form-tabs', 
  //   // 4. El offset ayuda a que la pestaña cambie un poco antes de tocar el borde
  //   offset: 50
  //   });
  // });
  //   var scrollElement = document.getElementById('content-scroll-area');
  // scrollElement.addEventListener('activate.bs.scrollspy', function (e) {
  //   console.log('Sección activa:', e.relatedTarget.getAttribute('href'));
  //   // Aquí podrías disparar la carga de datos si la sección está vacía
  // });

  document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('content-scroll-area');
    const tabs = document.querySelectorAll('#form-tabs .nav-link');
    const MARGEN_SUPERIOR = 15;
    //Inicializar ScrollSpy primero
    const scrollSpyInstance = new bootstrap.ScrollSpy(container, {
        target: '#form-tabs',
        offset: MARGEN_SUPERIOR + 5 // Un offset pequeño para mayor precisión
    });

    tabs.forEach(tab => {
      tab.addEventListener('click', function(e) {
        e.preventDefault();

        // 1. Obtener el ID del destino (#section-...)
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
          // 1. Quitamos la clase active de todos y la ponemos en el que clickeamos
          // Esto evita que el movimiento del scroll cambie la pestaña mientras viajamos
          tabs.forEach(t => t.classList.remove('active'));
          this.classList.add('active');

          // 2. Calculamos posición
          const targetTop = targetElement.offsetTop - MARGEN_SUPERIOR;

          // 3. Movemos el scroll
          container.scrollTo({
            top: targetTop,
            behavior: 'smooth'
          });

          // 4. "Refrescar" ScrollSpy después de que termine la animación (aprox 500ms)
          setTimeout(() => {
            scrollSpyInstance.refresh();
          }, 600);
        }
      });
    });

    // // 5. ScrollSpy dinámico para cuando el usuario usa la rueda del mouse
    // new bootstrap.ScrollSpy(container, {
    //     target: '#form-tabs',
    //     offset: MARGEN_SUPERIOR + 10,
    //     smoothScroll: true
    // });
  });
</script>
<!--
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
        <?php //$this->load->view('admin/inspecciones/_formularioEmpleador'); 
        ?>
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
        <?php //$this->load->view('admin/inspecciones/_formularioEstablecimiento'); 
        ?>
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
        <?php //$this->load->view('admin/inspecciones/_formularioTrabajadores');
        ?>
      </div>
    </div>
  </div>

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

            <div class="card shadow-sm mb-3 p-3" style="max-width:620px;">

                <div class="d-flex align-items-end justify-content-between gap-3">

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
</div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingDocs">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseDocs"
                aria-expanded="false"
                aria-controls="collapseDocs">
            Documentación cargada
        </button>
    </h2>

    <div id="collapseDocs"
         class="accordion-collapse collapse show"
         data-doc-upload-url="<?= base_url(INSPECCIONES_PATH . '/guardarDocumento') ?>"
data-doc-list-url="<?= base_url(INSPECCIONES_PATH . '/listarDocumentos/' . $inspeccion_id) ?>">


         
        <div class="accordion-body">

            <div class="card p-3 shadow-sm mb-3" style="max-width:620px;">

                <label class="form-label small text-muted">
                    Tipo de documento <span class="text-danger">*</span>
                </label>

                <select id="docTipo" class="form-select form-select-sm mb-2" required>
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
                    <input type="file" id="docFile" class="form-control form-control-sm" required>
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
</div>



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
        <?php //$this->load->view('admin/inspecciones/_formularioObservaciones');
        ?>
      </div>
    </div>
  </div>
</div>
-->
<script>
  // document.querySelectorAll('#form-tabs .nav-link').forEach(link => {
  //     link.addEventListener('click', function() {
  //         // Cambiar estado visual de las pestañas
  //         document.querySelectorAll('#form-tabs .nav-link').forEach(l => l.classList.remove('active'));
  //         this.classList.add('active');

  //         // Obtener el elemento destino
  //         const targetId = this.getAttribute('data-target');
  //         const targetElement = document.getElementById(targetId);
  //         const scrollContainer = document.getElementById('content-scroll-area');

  //         if (targetElement && scrollContainer) {
  //             // Calculamos la posición del elemento relativa al contenedor de scroll
  //             const targetPosition = targetElement.offsetTop - scrollContainer.offsetTop;

  //             scrollContainer.scrollTo({
  //                 top: targetPosition,
  //                 behavior: 'smooth'
  //             });
  //         }
  //     });
  // });
</script>