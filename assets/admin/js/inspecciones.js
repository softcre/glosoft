window.onload = function () {
	formatoTabla("tblInspecciones");
};

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

				// 1. Inyecta el contenido (la vista) en el cuerpo del modal
				$("#modal-large").html(data.data.view);
				$(modalElement).data("content-loaded", true);
				// 2. Muestra el modal utilizando la API de JS de Bootstrap 5
				const afiliacionModal = new bootstrap.Modal(modalElement);
				afiliacionModal.show();
				// $("#btnFormAfiliacion").removeClass("d-none");
				// $("#form_newAfiliacion").removeClass("d-none");
				// $("#form_newAfiliacion").html(data.data.view);
				// if (!data.data.isAfiliado) {
				// 	$("#nro_doc").val(data.data.dni);
				// 	$("#nro_doc").prop("readonly", true);
				// 	mostrarToast("error", "Error", data.data.msj);
				// }
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
	// }
	// 	e.preventDefault();
	// 	const formData = new FormData(e.target);
	// 	const btnName = "btnForm" + e.target.name;
	// 	const btn = document.getElementById(btnName);

	// 	$.ajax({
	// 		url: e.target.action,
	// 		method: "POST",
	// 		data: formData,
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,
	// 		beforeSend: function () {
	// 			btn.disabled = true;
	// 			btn.children[0].classList.remove("d-none");
	// 			btn.children[1].classList.add("d-none");
	// 		},
	// 		success: function (resp) {
	// 			let data = JSON.parse(resp);

	// 			if (data.status === "ok") {
	// 				const modalElement = document.getElementById('large');

	//         // 1. Inyecta el contenido (la vista) en el cuerpo del modal
	//         $('#modal-large').html(data.data.view);

	//         // 2. Muestra el modal utilizando la API de JS de Bootstrap 5
	//         const afiliacionModal = new bootstrap.Modal(modalElement);
	//         afiliacionModal.show();
	// 				// $("#btnFormAfiliacion").removeClass("d-none");
	// 				// $("#form_newAfiliacion").removeClass("d-none");
	// 				// $("#form_newAfiliacion").html(data.data.view);
	// 				// if (!data.data.isAfiliado) {
	// 				// 	$("#nro_doc").val(data.data.dni);
	// 				// 	$("#nro_doc").prop("readonly", true);
	// 				// 	mostrarToast("error", "Error", data.data.msj);
	// 				// }
	// 			} else {
	// 				mostrarErrors(data.title, data.errors);
	// 			}
	// 		},
	// 		error: ajaxErrors,
	// 		complete: function () {
	// 			btn.disabled = false;
	// 			btn.children[0].classList.add("d-none");
	// 			btn.children[1].classList.remove("d-none");
	// 		},
	// 	});
}

//-------------------ELIMINA UNA INSPECCION-------------------
function eliminar(ele) {
	const title = "Eliminar";
	const mensaje =
		"El acta de inspección N° " + ele.dataset.name + " se eliminará...";
	bajaRegistro(ele, ele.dataset.url, title, mensaje);
}
