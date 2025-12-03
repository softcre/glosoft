window.onload = function () {
	formatoTabla("tblInspecciones1")
	formatoTabla("tblInspecciones2")
  //formatoTabla("tblAudios");
};

function searchEmpleador(e) {
	const cuit = document.getElementById("empleador_cuit").value;
	const inspeccionId = document.getElementById("inspeccion_id").value;
	const div = document.getElementById("div_searchEmpleador");

	if (!cuit) {
		mostrarToast("error", "Error", "Por favor, ingrese el CUIT.");
		return;
	}

	const url = div.getAttribute("data-action");
	const btn = document.getElementById("btnFormSearchEmpleador");

	const data = {
		cuit: cuit,
		inspeccion_id: inspeccionId,
	};

	$.ajax({
		url: url,
		method: "POST",
		data: data,
		beforeSend: function () {
			btn.disabled = true;
			btn.children[0].classList.remove("d-none");
			btn.children[1].classList.add("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);

			if (data.status === "ok") {
				const modalElement = document.getElementById("large");
				$("#modal-large").html(data.data.view);
				$(modalElement).data("content-loaded", true);

				const empleadorModal = new bootstrap.Modal(modalElement);
				empleadorModal.show();
			} else {
				mostrarErrors(data.title, data.errors);
			}
		},
		error: ajaxErrors,
		complete: function () {
			btn.disabled = false;
			btn.children[0].classList.add("d-none");
			btn.children[1].classList.remove("d-none");
		},
	});
}

function setEmpleadorData(empleador) {
	$('#empleador_id').val(empleador.id_empleador); 
	$('#empleador_cuit').val(empleador.cuit);
	$('#empleador_razon_social').val(empleador.razon_social);
	$('#empleador_domicilio').val(empleador.domicilio);
	
	//$('#empleador_cuit').prop('readonly', true); // ver luego
}

function searchAfiliacion(e) {
	// 1. Recolectar datos y configuración
	const dni = document.getElementById("input_dni").value;
	const inspeccionId = document.getElementById("inspeccion_id").value;
	const div = document.getElementById("div_searchAfiliacion");

	// Si el DNI está vacío y es requerido, detener la ejecución.
	if (!dni) {
		mostrarToast("error", "Error", "Por favor, ingrese el DNI.");
		return;
	}

	const url = div.getAttribute("data-action");
	const btn = document.getElementById("btnFormSearchAfiliacion");
	console.log("url", url);
	// 2. Crear el objeto de datos (similar a lo que haría FormData)
	const data = {
		dni: dni,
		inspeccion_id: inspeccionId,
	};

	$.ajax({
		url: url,
		method: "POST",
		data: data,
		beforeSend: function () {
			btn.disabled = true;
			btn.children[0].classList.remove("d-none");
			btn.children[1].classList.add("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);

			if (data.status === "ok") {
				const modalElement = document.getElementById("large");
				$("#modal-large").html(data.data.view);
				$(modalElement).data("content-loaded", true);

				const afiliacionModal = new bootstrap.Modal(modalElement);
				afiliacionModal.show();
			} else {
				mostrarErrors(data.title, data.errors);
			}
		},
		error: ajaxErrors,
		complete: function () {
			btn.disabled = false;
			btn.children[0].classList.add("d-none");
			btn.children[1].classList.remove("d-none");
		},
	});
}

//-------------------ELIMINA UNA INSPECCION-------------------
function eliminar(ele) {
	const title = "Eliminar";
	const mensaje =
		"El acta de inspección N° " + ele.dataset.name + " se eliminará...";
	bajaRegistro(ele, ele.dataset.url, title, mensaje);
}
//----audio stuff
/* ============================================================
   AUDIO RECORDER MODULE
   ============================================================ */

let mediaRecorder;
let recordedChunks = [];
let audioBlob = null;

const uploadUrl = document
    .querySelector('#collapseAudio')
    .getAttribute('data-audio-upload-url');

// Buttons
const btnStart = document.getElementById("btnStartAudio");
const btnStop = document.getElementById("btnStopAudio");
const btnUpload = document.getElementById("btnUploadAudio");
const btnClear = document.getElementById("btnClearAudio");         // NEW

const audioPreview = document.getElementById("audioPreview");
const audioBlobData = document.getElementById("audioBlobData");
const inputTitulo = document.getElementById("audioTitulo");        // NEW

/* ============================================================
   INITIAL STATE FIX
   ============================================================ */

// FIX: ensure proper startup state
if (btnClear) btnClear.disabled = true;                            // FIX
if (btnStop) btnStop.disabled = true;                              // FIX
if (btnUpload) btnUpload.disabled = true;                          // FIX


/* ============================================================
   EVENT BINDING
   ============================================================ */
if (btnStart) {
    btnStart.addEventListener("click", startRecording);
    btnStop.addEventListener("click", stopRecording);
    btnUpload.addEventListener("click", uploadRecording);

    if (btnClear) btnClear.addEventListener("click", clearRecording);
}

if (inputTitulo) {
    inputTitulo.addEventListener('input', function () {
        inputTitulo.classList.remove('is-invalid');

        if (audioBlob && btnUpload) {
            btnUpload.disabled = (inputTitulo.value.trim() === "");
        }
    });
}


/* ============================================================
   START RECORDING
   ============================================================ */
function startRecording() {
    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
            recordedChunks = [];
            audioPreview.classList.add("d-none");

            mediaRecorder = new MediaRecorder(stream);
            mediaRecorder.ondataavailable = e => recordedChunks.push(e.data);
            mediaRecorder.onstop = handleRecordingStop;

            mediaRecorder.start();

            btnStart.disabled = true;
            btnStop.disabled = false;
            btnUpload.disabled = true;

            if (btnClear) btnClear.disabled = true;
        })
        .catch(err => {
            mostrarToast("error", "Micrófono bloqueado", "Debe habilitar permisos de audio.");
        });
}


/* ============================================================
   STOP RECORDING
   ============================================================ */
function stopRecording() {
    if (!mediaRecorder) return;
    mediaRecorder.stop();
    btnStop.disabled = true;
}


/* ============================================================
   HANDLE RECORDING STOP
   ============================================================ */
function handleRecordingStop() {
    audioBlob = new Blob(recordedChunks, { type: "audio/webm" });

    const audioURL = URL.createObjectURL(audioBlob);
    audioPreview.src = audioURL;
    audioPreview.classList.remove("d-none");

    const reader = new FileReader();
    reader.onloadend = function () {
        audioBlobData.value = reader.result;
    };
    reader.readAsDataURL(audioBlob);

    // FIX: btnUpload depends on titulo
    const tituloOK = inputTitulo && inputTitulo.value.trim() !== "";
    btnUpload.disabled = !tituloOK;

    if (btnClear) btnClear.disabled = false;
}


/* ============================================================
   UPLOAD RECORDING
   ============================================================ */
function uploadRecording() {
    const base64 = audioBlobData.value;
    const inspeccion_id = document.getElementById("inspeccion_id").value;
    const titulo = (inputTitulo ? inputTitulo.value.trim() : "");

    // FIX: ensure audio exists
    if (!audioBlob || !base64) {
        mostrarToast("error", "Sin grabación", "Debe grabar un audio antes de subirlo.");
        return;
    }

    // FIX: ensure title is present
    if (!titulo) {
        if (inputTitulo) {
            inputTitulo.classList.add('is-invalid');
            inputTitulo.focus();
        }
        mostrarToast("error", "Falta título", "Por favor escriba un título para el audio.");
        return;
    }

    const url = btnUpload.getAttribute("data-upload-url");

    $.ajax({
        url: url,
        method: "POST",
        data: { audio: base64, inspeccion_id, titulo },
        beforeSend: function () {
            btnUpload.disabled = true;
        },
        success: function (resp) {
            let data = JSON.parse(resp);

            if (data.status === "ok") {
                mostrarToast("success", "Audio guardado", "El archivo se registró correctamente");
                clearRecording();
                loadTblAudios();
            } else {
                mostrarToast("error", "Error", data.message);
            }
        },
        error: ajaxErrors,
        complete: function () {
            btnStart.disabled = false;
        }
    });
}


/* ============================================================
   CLEAR RECORDING
   ============================================================ */
function clearRecording() {
    audioBlob = null;
    recordedChunks = [];
    audioBlobData.value = "";

    audioPreview.src = "";
    audioPreview.classList.add("d-none");

    if (inputTitulo) {
        inputTitulo.value = "";
        inputTitulo.classList.remove("is-invalid");
    }

    btnStart.disabled = false;
    btnStop.disabled = true;
    btnUpload.disabled = true;

    if (btnClear) btnClear.disabled = true;
}


/* ============================================================
   DELETE AUDIO
   ============================================================ */
function eliminarAudio(ele) {
    const title = "Eliminar";
    const mensaje = "El audio  N° " + ele.dataset.name + " se eliminará...";
    bajaRegistro(ele, ele.dataset.url, title, mensaje);
}


/* ============================================================
   LOAD TABLE
   ============================================================ */
function loadTblAudios() {
    const div = document.getElementById("div_tblAudios");
    const url = div.getAttribute("data-url");

    $.post(url, {}, function (view) {
        $("#div_tblAudios").html(view);
        formatoTabla("tblAudios");
    });
}

$(document).ready(function () {
    if (document.getElementById("div_tblAudios")) {
        loadTblAudios();
    }
});

  //documentos
/* ============================================================
  DOCUMENT UPLOAD MODULE
  ============================================================ */

  const docContainer = document.getElementById("collapseDocs");
  if (docContainer) initDocumentModule();

  function initDocumentModule() {

      /* ------------------------------------------------------------
        ELEMENTS
        ------------------------------------------------------------ */
      //const uploadUrl = docContainer.getAttribute('data-doc-upload-url');
      const uploadUrl = document
                              .querySelector('#collapseDocs')
                              .getAttribute('data-doc-upload-url');
      const listUrl   = docContainer.getAttribute('data-doc-list-url');

      const docTipo   = document.getElementById("docTipo");
      const docFile   = document.getElementById("docFile");
      const btnUpload = document.getElementById("btnUploadDoc");

      const divTabla  = document.getElementById("div_tblDocumentos");

      /* ------------------------------------------------------------
        INITIAL STATE
        ------------------------------------------------------------ */
      btnUpload.disabled = true;


      /* ------------------------------------------------------------
        VALIDATION OF INPUTS
        ------------------------------------------------------------ */
      function validateForm() {
          const tipoOK = docTipo.value.trim() !== "";
          const fileOK = docFile.files.length > 0;

          btnUpload.disabled = !(tipoOK && fileOK);

          docTipo.classList.remove("is-invalid");
          docFile.classList.remove("is-invalid");
      }

      docTipo.addEventListener("change", validateForm);
      docFile.addEventListener("change", validateForm);


      /* ------------------------------------------------------------
        UPLOAD DOCUMENT
        ------------------------------------------------------------ */
      btnUpload.addEventListener("click", function () {

          const tipo = docTipo.value.trim();
          const file = docFile.files[0];

          if (!tipo) {
              docTipo.classList.add("is-invalid");
              mostrarToast("error", "Falta tipo", "Debe seleccionar un tipo de documento.");
              return;
          }

          if (!file) {
              docFile.classList.add("is-invalid");
              mostrarToast("error", "Archivo faltante", "Debe seleccionar un archivo.");
              return;
          }

          const inspeccion_id = document.getElementById("inspeccion_id").value;

          // PACK FILE IN FORMDATA
          let formData = new FormData();
          //formData.append("tipo", tipo);
          formData.append("titulo", tipo);
          //formData.append("archivo", file);
          formData.append("documento", file);
          formData.append("inspeccion_id", inspeccion_id);

          $.ajax({
              url: uploadUrl,
              method: "POST",
              data: formData,
              contentType: false,
              processData: false,
              beforeSend: function () {
                  btnUpload.disabled = true;
              },
              success: function (resp) {
                  let data = JSON.parse(resp);

                  if (data.status === "ok") {
                      mostrarToast("success", "Documento guardado", "El archivo se registró correctamente.");
                      clearForm();
                      loadTblDocumentos();
                  } else {
                      mostrarToast("error", "Error", data.message);
                  }
              },
              error: ajaxErrors,
              complete: function () {
                  validateForm();
              }
          });

      });


      /* ------------------------------------------------------------
        CLEAR FORM
        ------------------------------------------------------------ */
      function clearForm() {
          docTipo.value = "";
          docFile.value = "";

          docTipo.classList.remove("is-invalid");
          docFile.classList.remove("is-invalid");

          btnUpload.disabled = true;
      }


      /* ------------------------------------------------------------
        LOAD DOCUMENT TABLE
        ------------------------------------------------------------ */
      function loadTblDocumentos() {
          const url = divTabla.getAttribute("data-url");

          $.post(url, {}, function (view) {
              $("#div_tblDocumentos").html(view);
              formatoTabla("tblDocumentos");
          });
      }


      /* ------------------------------------------------------------
        DELETE DOCUMENT
        ------------------------------------------------------------ */
      window.eliminarDocumento = function(ele) {
          const id   = ele.dataset.name;
          const url  = ele.dataset.url;

          const title   = "Eliminar documento";
          const mensaje = "El documento N° " + id + " se eliminará...";

          bajaRegistro(ele, url, title, mensaje, null, function() {
              loadTblDocumentos();
          });
      };


      /* ------------------------------------------------------------
        AUTO-LOAD TABLE ON PAGE LOAD
        ------------------------------------------------------------ */
      loadTblDocumentos();
  }

