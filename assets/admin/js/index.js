const BASE_URL =
	location.origin +
	(location.hostname == "localhost" ? "/glosoft/" : "/");

const CARGANDO_HTML = `<div class="text-center text-primary my-4"><i class="fas fa-spinner fa-pulse fa-3x mb-3"></i><h6><b>Cargando ...</b></h6></div>`;

// DEFINICION DE TOAST (alert)
const Toast = Swal.mixin({
	toast: true,
	position: "top",
	showConfirmButton: false,
	timer: 6000,
});

// DEFINICION DE TOAST (alert) para newsletter
const Toast_news = Swal.mixin({
	toast: true,
	position: "top",
	showConfirmButton: false,
	timer: 1800,
});

//---------------------MUESTRA MENSAJE TOAST para newsletter---------------------
function mostrarToast_news(icon, titulo, msj) {
	Toast_news.fire({
		icon: icon,
		title: titulo,
		text: msj,
	});
}

//---------------------MUESTRA MENSAJE TOAST---------------------
function mostrarToast(icon, titulo, msj) {
	Toast.fire({
		icon: icon,
		title: titulo,
		text: msj,
	});
}

//-------------CARGA VISTA MODAL DE FORMULARIO (small)------------
function cargarFormSmall(metodo) {
	$.post(metodo, function (data) {
		$("#modal-small").html(data);
		// // Initialize and show Bootstrap 5 modal
		// const modalElement = document.getElementById('small');
		// if (modalElement) {
		// 	// Check if modal instance already exists, if so use it, otherwise create new
		// 	let modalInstance = bootstrap.Modal.getInstance(modalElement);
		// 	if (!modalInstance) {
		// 		modalInstance = new bootstrap.Modal(modalElement, {
		// 			backdrop: true,
		// 			keyboard: true,
		// 			focus: true
		// 		});
		// 	}
		// 	modalInstance.show();
		// }
	}).fail(ajaxErrors);
}

//-------------CARGA VISTA MODAL DE FORMULARIO (large)------------
function cargarFormLarge(metodo) {
	$.post(metodo, function (data) {
		$("#modal-large").html(data);
	}).fail(ajaxErrors);
}

//------------------ALTA - MODIFICACION GENERAL------------------
function altaUpdate(e) {
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
				if (data.data.selector != undefined) {
					// solo cuando hay que recargar tablas
					let selector = data.data.selector.toLowerCase();
					$("#" + selector + "-main").html(data.data.view);
					formatoTabla("tbl" + data.data.selector);
				}

				mostrarToast("success", data.title, data.msj);

				if (data.data.url != undefined) {
					setTimeout(() => (location.href = data.data.url), 1500);
				} else {
					$("#cerrarModal").click();
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

//-------------------------ALTA - NUEVA INSCRICION A TORNEO GAMER

function altaUpdateTorneoGamer(e) {
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
				if (data.data.selector != undefined) {
					// solo cuando hay que recargar tablas
					let selector = data.data.selector.toLowerCase();
					$("#" + selector + "-main").html(data.data.view);
					formatoTabla("tbl" + data.data.selector);
				}

				mostrarToast("success", data.title, data.msj);

				// Forzar redirección sin condiciones ni espera
				location.href =
					"<?= base_url(EQUIPO_GAMER_PATH . '/indexNuevoEquipoGamer') ?>";
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

//-----------------------ALTA - NUEVA INSCRIPCION

function altaUpdateInscripcion(e) {
	e.preventDefault();
	const formData = new FormData(e.target);
	const btnName = "btnForm" + e.target.name;
	const btn = document.getElementById(btnName);

	$.ajax({
		url: "http://localhost/tresolqa/gamerpanel/equiposgamer/crearInscripcion",
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
				if (data.data.selector != undefined) {
					// solo cuando hay que recargar tablas
					let selector = data.data.selector.toLowerCase();
					$("#" + selector + "-main").html(data.data.view);
					formatoTabla("tbl" + data.data.selector);
				}

				mostrarToast("success", data.title, data.msj);

				if (data.data.url != undefined) {
					setTimeout(() => (location.href = data.data.url), 1500);
				} else {
					$("#cerrarModal").click();
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

//------------------ALTA - para usar con newsletter en anonimo index------------------
function altaUpdate_news(e) {
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
		/* beforeSend: function () {
			btn.disabled = true;
			btn.children[0].classList.remove("d-none");
			btn.children[1].classList.add("d-none");
		}, */
		success: function (resp) {
			let data = JSON.parse(resp);

			if (data.status === "ok") {
				if (data.data.selector != undefined) {
					// solo cuando hay que recargar tablas
					let selector = data.data.selector.toLowerCase();
					$("#" + selector + "-main").html(data.data.view);
					formatoTabla("tbl" + data.data.selector);
				}
				// Set flag in localStorage to indicate page has been loaded
				// localStorage.setItem('pageLoaded', true);

				// Close the modal
				//document.getElementById('myModal').style.display = 'none';

				mostrarToast_news("success", data.title, data.msj);

				if (data.data.url != undefined) {
					setTimeout(() => (location.href = data.data.url), 1500);
				} else {
					$("#cerrarModal").click();
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

//----------------CAMBIA EL ESTADO DE UN REGISTRO----------------
function bajaRegistro(e, metodo, titulo, msj) {
	Swal.fire({
		title: "¿" + titulo + "?",
		text: msj,
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#2c9faf",
		cancelButtonColor: "#d33",
		confirmButtonText: "Sí!",
		cancelButtonText: "Cancelar",
	}).then((result) => {
		if (result.value) {
			$.post(
				metodo,
				function (data) {
					if (data.status === "ok") {
						mostrarToast("success", data.title, data.msj);
						$(e).closest("tr").fadeOut(1200);
					} else {
						mostrarErrors(data.title, data.errors);
					}
				},
				"json"
			).fail(ajaxErrors);
		}
	});
}

//----------------CAMBIA EL ESTADO DE UN PAGO HECHO EN PUERTA----------------
function registrarPago(e, metodo, titulo, msj) {
	Swal.fire({
		title: "¿" + titulo + "?",
		text: msj,
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#2c9faf",
		cancelButtonColor: "#d33",
		confirmButtonText: "Sí!",
		cancelButtonText: "Cancelar",
	}).then((result) => {
		if (result.value) {
			$.post(
				metodo,
				function (data) {
					if (data.status === "ok") {
						mostrarToast("success", data.title, data.msj);
						if (data.data.url != undefined) {
							setTimeout(() => (location.href = data.data.url), 1500);
						}
						//$(e).closest("tr").fadeOut(1200);
					} else {
						mostrarErrors(data.title, data.errors);
					}
				},
				"json"
			).fail(ajaxErrors);
		}
	});
}

//--------------------------SUBIR FOTO--------------------------
function subirFoto(input) {
	if (validarFile(input)) return;

	if (input.files && input.files[0]) {
		let reader = new FileReader();

		reader.onload = function (e) {
			$("#foto").attr("src", e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

//-----------------VALIDAR EXTENSION DE ARCHIVO-----------------
function validarFile(all) {
	$("#noFoto").addClass("d-none");
	//EXTENSIONES Y TAMANO PERMITIDO.
	let extensiones_permitidas = [".png", ".bmp", ".jpg", ".jpeg"];
	//let tamano = 8; // EXPRESADO EN MB.
	let rutayarchivo = all.value;
	let ultimo_punto = all.value.lastIndexOf(".");
	let extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
	if (rutayarchivo == "") return false;

	if (extensiones_permitidas.indexOf(extension.toLowerCase()) == -1) {
		$("#noFoto").removeClass("d-none");
		$("#noFoto > small").text("Extensión de archivo no valida");
		document.getElementById(all.id).value = "";
		setTimeout(function () {
			$("#noFoto").fadeOut(1500);
		}, 4000);
		return true; // Si la extension es no válida ya no chequeo lo de abajo.
	}
	// if ((all.files[0].size / 1048576) > tamano) {
	// 	alert("El archivo no puede superar los " + tamano + "MB");
	// 	document.getElementById(all.id).value = "";
	// 	return true;
	// }
	return false;
}

//////////////////////////////////////////////////////////////////////////////
///para subir foto con formado pdf y doc de polizas, se utiliza el mismo nombre que estudios tac.
///////////////////////////////////////////////////

function subirFoto2(input) {
	// Check if the file is valid using the validarFileEcg function
	if (validarFile2(input)) return;

	// Check if files are present in the input
	if (input.files && input.files[0]) {
		// Create a new FileReader object
		let reader = new FileReader();

		// Define an event handler for when the FileReader has successfully read the file
		reader.onload = function (e) {
			// Determine the file type based on its extension
			let fileType = getFileExtension(input.files[0].name);

			// Set the source attribute of the HTML image element with the id "fotoecg" based on the file type
			if (fileType === "pdf") {
				$("#foto").attr("src", BASE_URL + "assets/img/polizas/pdf.png");
			} else if (fileType === "doc" || fileType === "docx") {
				$("#foto").attr("src", BASE_URL + "assets/img/polizas/docx.png");
			} else {
				// For other file types, show the actual image
				$("#foto").attr("src", e.target.result);
			}
		};

		// Define an event handler for when the FileReader encounters an error
		reader.onerror = function (e) {
			// If there's an error, set the source attribute of the HTML image element with the id "fototac" to a default image URL
			$("#foto").attr("src", BASE_URL + "assets/img/polizas/no-image.jpg");
		};

		// Read the content of the first file in the input as a data URL
		reader.readAsDataURL(input.files[0]);
	}
}
//-----------------VALIDAR EXTENSION DE ARCHIVO-----------------
function validarFile2(all) {
	$("#noFoto").addClass("d-none");
	//EXTENSIONES Y TAMANO PERMITIDO.
	let extensiones_permitidas = [
		".png",
		".bmp",
		".jpg",
		".jpeg",
		".pdf",
		".doc",
		".docx",
	];
	//let tamano = 8; // EXPRESADO EN MB.
	let rutayarchivo = all.value;
	let ultimo_punto = all.value.lastIndexOf(".");
	let extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
	if (rutayarchivo == "") return false;

	if (extensiones_permitidas.indexOf(extension.toLowerCase()) == -1) {
		$("#noFoto").removeClass("d-none");
		$("#noFoto > small").text("Extensión de archivo no valida");
		document.getElementById(all.id).value = "";
		setTimeout(function () {
			$("#noFoto").fadeOut(1500);
		}, 4000);
		return true; // Si la extension es no válida ya no chequeo lo de abajo.
	}
	// if ((all.files[0].size / 1048576) > tamano) {
	// 	alert("El archivo no puede superar los " + tamano + "MB");
	// 	document.getElementById(all.id).value = "";
	// 	return true;
	// }
	return false;
}

//---------------------DA FORMATO A TABLA---------------------
function formatoTabla(tabla) {
	return $("#" + tabla).DataTable({
		responsive: true,
		lengthChange: true,
		autoWidth: false,
		//dom: 'Blfrtip',
		/* buttons: [
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5',
        'print', // Add the print button
    ], */
		//lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
		/*  buttons: [
      {
        extend: 'csv',
        text: 'Exportar CSV', // Change the text for CSV button
        titleAttr: 'Exportar a CSV' // Change the title attribute for CSV button
      },
      {
        extend: 'excel',
        text: 'Exportar Excel', // Change the text for Excel button
        titleAttr: 'Exportar a Excel' // Change the title attribute for Excel button
      },
      {
        extend: 'pdf',
        text: 'Exportar PDF', // Change the text for PDF button
        titleAttr: 'Exportar a PDF' // Change the title attribute for PDF button
      },
      {
        extend: 'print',
        text: 'Imprimir', // Change the text for Print button
        titleAttr: 'Imprimir la tabla' // Change the title attribute for Print button
      }
    ], */
		order: [],
		language: {
			processing: "Procesando...",
			search: "Buscar",
			lengthMenu: "Mostrar _MENU_ registros",
			info: "Desde _START_ a _END_ de _TOTAL_ registros",
			infoEmpty: "No existen datos",
			infoFiltered: "(Total filtrado de _MAX_ registros)",
			infoPostFix: "",
			loadingRecords: "Guardando...",
			zeroRecords: "Sin registros",
			emptyTable: "No hay datos disponibles",
			paginate: {
				first: "Inicio",
				previous: "Anterior",
				next: "Próximo",
				last: "Ultimo",
			},
			aria: {
				sortAscending: ": Activar para ordenar la columna en orden ascendente",
				sortDescending:
					": Activar para ordenar la columna en orden descendente.",
			},
		},
		initComplete: function () {
			// saber si la tabla esta definida
			if ($.fn.dataTable.isDataTable("#" + tabla)) {
				let objTabla = $("#" + tabla).DataTable();
				volverApagina(objTabla);
			}
		},
	});
}

//---------------VUELVE A PAGINA ESPECIFICA TABLE---------------
function volverApagina(tabla) {
	let pagina = localStorage.getItem("pagina_actual");

	// Preguntamos si existe el item
	if (pagina != undefined) {
		//Decimos a la table que cargue la página requerida
		tabla.page(parseInt(pagina)).draw("page");

		//Eliminamos el item para que no genere conflicto a la hora de dar click en otro botón detalle
		localStorage.removeItem("pagina_actual");
	}
}

//------------------------MUESTRA ERRORES------------------------
function mostrarErrors(titulo, errores) {
	let div = document.createElement("div");
	let ul = document.createElement("ul");

	for (let error in errores) {
		let li = document.createElement("li");
		let text = document.createTextNode(errores[error]);
		li.appendChild(text);
		ul.appendChild(li);
	}

	ul.style.setProperty("list-style", "none");
	ul.classList.add("p-0", "my-1");
	div.appendChild(ul);
	div.classList.add("alert", "alert-danger", "text-sm", "text-left", "py-1");

	Swal.fire({
		icon: "error",
		title: titulo,
		html: div,
		confirmButtonColor: "#5bc0de",
		confirmButtonText: "Aceptar",
	});
}

//------------------------ERRORES DE AJAX------------------------
function ajaxErrors(jqXHR, textStatus) {
	if (jqXHR.status === 0) {
		Swal.fire("Sin Conexion", "Verifique su conexion a internet!", "error");
	} else if (jqXHR.status == 404) {
		Swal.fire("Error (404)", "No se encontro la pagina solicitada!", "error");
	} else if (jqXHR.status == 500) {
		Swal.fire("Error (500)", "Hubo un Error en el Servidor!", "error");
	} else if (textStatus === "parsererror") {
		Swal.fire("Error", "Requested JSON parse failed.", "error");
	} else if (textStatus === "timeout") {
		Swal.fire("Error", "Time out error.", "error");
	} else if (textStatus === "abort") {
		Swal.fire("Error", "Ajax request aborted.", "error");
	} else {
		Swal.fire("Error", "Uncaught Error: " + jqXHR.responseText, "error");
	}
}
