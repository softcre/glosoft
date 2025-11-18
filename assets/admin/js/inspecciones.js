window.onload = function () {
	formatoTabla("tblInspecciones");
};

function searchAfiliacion(e) {
	e.preventDefault();
	const formData = new FormData(e.target);
	const btnName = "btnForm" + e.target.name;
	const btn = document.getElementById(btnName);

	$.ajax({
		url: e.target.action,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			btn.disabled = true;
			btn.children[0].classList.remove("d-none");
			btn.children[1].classList.add("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);

			if (data.status === "ok") {
				$("#btnFormAfiliacion").removeClass("d-none");
				$("#form_newAfiliacion").removeClass("d-none");
				$("#form_newAfiliacion").html(data.data.view);
				if (!data.data.isAfiliado) {
					$("#nro_doc").val(data.data.dni);
					$("#nro_doc").prop("readonly", true);
					mostrarToast("error", "Error", data.data.msj);
				}
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
