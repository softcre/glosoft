window.onload = function () {
	formatoTabla("tblInspecciones");
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
