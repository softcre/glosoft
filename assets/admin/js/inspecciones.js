window.onload = function () {
	formatoTabla("tblInspecciones")
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


// buttons
const btnStart = document.getElementById("btnStartAudio");
const btnStop = document.getElementById("btnStopAudio");
const btnUpload = document.getElementById("btnUploadAudio");
const audioPreview = document.getElementById("audioPreview");
const audioBlobData = document.getElementById("audioBlobData");

// Bind events AFTER DOM loads
if (btnStart) {
    btnStart.addEventListener("click", startRecording);
    btnStop.addEventListener("click", stopRecording);
    btnUpload.addEventListener("click", uploadRecording);
}

// Start recording
function startRecording() {
    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(stream => {
            recordedChunks = [];
            audioPreview.classList.add("d-none");

            mediaRecorder = new MediaRecorder(stream);
            mediaRecorder.ondataavailable = event => recordedChunks.push(event.data);
            mediaRecorder.onstop = handleRecordingStop;

            mediaRecorder.start();

            btnStart.disabled = true;
            btnStop.disabled = false;
            btnUpload.disabled = true;
        })
        .catch(err => {
            mostrarToast("error", "Micrófono bloqueado", "Debe habilitar permisos de audio.");
        });
}

// Stop recording
function stopRecording() {
    mediaRecorder.stop();
    btnStop.disabled = true;
}

// When recording stops
function handleRecordingStop() {
    audioBlob = new Blob(recordedChunks, { type: "audio/webm" });

    const audioURL = URL.createObjectURL(audioBlob);
    audioPreview.src = audioURL;
    audioPreview.classList.remove("d-none");

    // Convert to base64 for upload
    const reader = new FileReader();
    reader.onloadend = function () {
        audioBlobData.value = reader.result; // base64
    };
    reader.readAsDataURL(audioBlob);

    btnUpload.disabled = false;
}

// Upload recording
function uploadRecording() {

    const base64 = audioBlobData.value;
    const inspeccion_id = document.getElementById("inspeccion_id").value;

    // Get the correct controller route exactly like your other methods
    const url = btnUpload.getAttribute("data-upload-url");

    $.ajax({
        url: url,
        method: "POST",
        data: { audio: base64, inspeccion_id },
        beforeSend: function () {
            btnUpload.disabled = true;
        },
        success: function (resp) {
            let data = JSON.parse(resp);

            if (data.status === "ok") {
                mostrarToast("success", "Audio guardado", "El archivo se registró correctamente");
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


/* Load audio records table */
function loadTblAudios() {
    const div = document.getElementById("div_tblAudios");
    const url = div.getAttribute("data-url");

    $.post(url, {}, function (view) {
        $("#div_tblAudios").html(view);
        formatoTabla("tblAudios");
    });
}

// Auto-load table if exists
$(document).ready(function () {
    if (document.getElementById("div_tblAudios")) {
        loadTblAudios();
    }
});
