<?php $this->load->view('admin/components/_head', ['log' => false]); ?>

<body class="hold-transition bg-body-secondary">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-9">

        <div class="card card-outline card-warning shadow-sm">
          <div class="card-header py-2 text-center">
            <h4 class="mb-0 fw-semibold">Denuncias</h4>
            <small class="text-muted">Envíanos tu reclamo</small>
          </div>

          <div class="card-body">

            <div class="alert alert-warning small text-center mb-3">
              <strong>IMPORTANTE</strong><br>
              Aunque se soliciten ciertos datos, la denuncia es absolutamente anónima.
              Es esencial proporcionar todos los datos requeridos sin omisiones para
              garantizar una respuesta inmediata y efectiva.
            </div>

            <form id="form_denuncia" name="form_denuncia" action="<?= base_url(DENUNCIA_PATH . '/crear') ?>" method="post" enctype="multipart/form-data">

              <h6 class="text-muted text-uppercase mt-2 mb-2">Datos personales</h6>

              <div class="input-group mb-2">
                <div class="form-floating flex-grow-1">
                  <input type="text" name="nombre" class="form-control" id="nombre" placeholder="">
                  <label for="nombre">Nombre y Apellido</label>
                </div>
                <div class="input-group-text"><i class="bi bi-person"></i></div>
              </div>

              <div class="input-group mb-2">
                <div class="form-floating flex-grow-1">
                  <input type="email" name="email" class="form-control" id="email" placeholder="">
                  <label for="email">Mail</label>
                </div>
                <div class="input-group-text"><i class="bi bi-envelope"></i></div>
              </div>

              <div class="input-group mb-2">
                <div class="form-floating flex-grow-1">
                  <input type="text" name="telefono" class="form-control" id="telefono" placeholder="">
                  <label for="telefono">Teléfono</label>
                </div>
                <div class="input-group-text"><i class="bi bi-telephone"></i></div>
              </div>

              <div class="input-group mb-3">
                <div class="form-floating flex-grow-1">
                  <input type="text" name="contacto_alt" class="form-control" id="contacto_alt" placeholder="">
                  <label for="contacto_alt">Contacto alternativo</label>
                </div>
                <div class="input-group-text"><i class="bi bi-chat-dots"></i></div>
              </div>

              <h6 class="text-muted text-uppercase mt-3 mb-2">Datos del empleador</h6>

              <div class="form-floating mb-2">
                <input type="text" name="razon_social" class="form-control" id="razon_social" placeholder="">
                <label for="razon_social">Nombre o Razón Social</label>
              </div>

              <div class="form-floating mb-2">
                <input type="text" name="cuit" class="form-control" id="cuit" placeholder="">
                <label for="cuit">Número de CUIT</label>
              </div>

              <div class="row g-2 mb-2">
                <div class="col-md-6">
                  <label for="provincia" class="form-label small text-muted">Provincia</label>
                  <select class="form-select" id="provincia" name="provincia_id">
                    <option value="">Seleccione una provincia</option>
                    <?php if (isset($provincias) && is_array($provincias)) : ?>
                      <?php foreach ($provincias as $prov) : ?>
                        <option value="<?= $prov->id_provincia; ?>">
                          <?= $prov->nombre; ?>
                        </option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="localidad" class="form-label small text-muted">Localidad</label>
                  <select class="form-select" id="localidad" name="localidad_id" disabled>
                    <option value="">Seleccione una localidad</option>
                  </select>
                </div>
              </div>

              <div class="mb-2">
                <label class="form-label small text-muted">Adjuntar archivo</label>
                <input type="file" name="archivo" class="form-control">
                <small class="text-muted">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, GIF, TXT, CSV, ZIP, RAR, PPT, PPTX</small>
              </div>

              <div class="form-floating mb-3">
                <textarea name="descripcion" class="form-control" id="descripcion"
                          style="height: 120px" placeholder=""></textarea>
                <label for="descripcion">Describa su denuncia</label>
              </div>

              <div class="d-grid mt-3">
                <button type="submit" id="btnFormform_denuncia" class="btn btn-warning" name="button">
                  <div class="d-none">
                    <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                    Enviando...
                  </div>
                  <span><i class="bi bi-send me-2"></i> Enviar denuncia</span>
                </button>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php $this->load->view('admin/components/_scripts', ['log' => false]); ?>
  <script>
    // Function to load localidades by provincia
    function cargarLocalidades(provinciaId) {
      const localidadSelect = $('#localidad');
      
      if (!provinciaId || provinciaId === '') {
        localidadSelect.html('<option value="">Seleccione una localidad</option>');
        localidadSelect.prop('disabled', true);
        return;
      }
      
      localidadSelect.prop('disabled', false);
      localidadSelect.html('<option value="">Cargando...</option>');
      
      const url = '<?= base_url(DENUNCIA_PATH . "/getLocalidades") ?>';
      
      $.ajax({
        url: url,
        method: 'POST',
        data: {
          provincia_id: provinciaId
        },
        success: function(resp) {
          try {
            let data = typeof resp === 'string' ? JSON.parse(resp) : resp;
            
            if (data.status === 'ok' && data.data && data.data.localidades) {
              localidadSelect.html('<option value="">Seleccione una localidad</option>');
              
              if (data.data.localidades.length > 0) {
                $.each(data.data.localidades, function(index, localidad) {
                  localidadSelect.append(
                    $('<option></option>')
                      .attr('value', localidad.id_localidad)
                      .text(localidad.nombre)
                  );
                });
              } else {
                localidadSelect.html('<option value="">No hay localidades disponibles</option>');
              }
            } else {
              localidadSelect.html('<option value="">No hay localidades disponibles</option>');
            }
          } catch (e) {
            console.error('Error parsing response:', e, resp);
            localidadSelect.html('<option value="">Error al cargar localidades</option>');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error loading localidades:', error);
          localidadSelect.html('<option value="">Error al cargar localidades</option>');
        }
      });
    }
    
    // Handle provincia change
    $(document).on('change', '#provincia', function() {
      const provinciaId = $(this).val();
      cargarLocalidades(provinciaId);
    });

    // Handle form submission
    $('#form_denuncia').on('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      const btnName = 'btnForm' + this.name;
      const btn = document.getElementById(btnName);

      $.ajax({
        url: this.action,
        method: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          btn.disabled = true;
          btn.children[0].classList.remove('d-none');
          btn.children[1].classList.add('d-none');
        },
        success: function(resp) {
          let data = typeof resp === 'string' ? JSON.parse(resp) : resp;

          if (data.status === 'ok') {
            mostrarToast('success', data.title, data.msj);

            if (data.data.url != undefined) {
              setTimeout(() => (location.href = data.data.url), 1500);
            }
          } else {
            mostrarErrors(data.title, data.errors);
          }
        },
        error: ajaxErrors,
        complete: function() {
          btn.disabled = false;
          btn.children[0].classList.add('d-none');
          btn.children[1].classList.remove('d-none');
        }
      });
    });
  </script>
</body>
