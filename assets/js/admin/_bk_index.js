// CAMBIAR EN SERVER
// const pathInicial = "/agrodomo/"; // cambiar por '/'
// const baseUrl = window.location.origin + pathInicial;

// DEFINICION DE TOAST (alert)
const Toast = Swal.mixin({
	toast: true,
	position: "top",
	showConfirmButton: false,
	timer: 6000,
});

// // Para regargar la pagina de history.pushState
// window.onpopstate = function (event) {
// 	//if(event && event.state) {
// 	location.reload();
// 	//}
// };

// $(function () {
// 	if (
// 		location.pathname != pathInicial &&
// 		location.pathname != pathInicial + "admin"
// 	) {
// 		getCCVencidas();
// 	}
// });

//------------------------FECHA Y HORA ACTUAL------------------------
function fechaHoraHoy() {
	// retorna dd/mm/yyyy H:m
	let fHoy = new Date();
	let fecha = [
		("0" + fHoy.getDate()).slice(-2),
		("0" + (fHoy.getMonth() + 1)).slice(-2),
		fHoy.getFullYear(),
	].join("/");
	let hora = [
		("0" + fHoy.getHours()).slice(-2),
		("0" + fHoy.getMinutes()).slice(-2),
	].join(":");
	return fecha + " " + hora;
}

//------------------------FECHA ACTUAL------------------------
function fechaHoy() {
	// retorna yyyy-mm-dd
	let fHoy = new Date();
	return [
		fHoy.getFullYear(),
		("0" + (fHoy.getMonth() + 1)).slice(-2),
		("0" + fHoy.getDate()).slice(-2),
	].join("-");
}

//---------------------DA FORMATO A TABLA---------------------
function formatoTabla(tabla) {
	return $("#" + tabla).DataTable({
		responsive: true,
		autoWidth: false,
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

//----------------CARGA VISTA MODAL DE FORMULARIO---------------
function cargarForm(metodo, modal, selector) {
	$.post(metodo, function (data) {
		$("#" + selector).html(data);
		$("#" + modal).modal();
	}).fail(ajaxErrors);
}

//---------CARGA VISTA MODAL DE FORMULARIO MEDIO DE PAGO--------
function cargarFormMP(metodo, modal, selector) {
	let id_cliente = $("#id_cliente").val();

	$.post(metodo, { id_cliente: id_cliente }, function (data) {
		$("#" + selector).html(data);
		$("#" + modal).modal();
	}).fail(ajaxErrors);
}

//----------------CARGA VISTA PAGE DE FORMULARIO---------------
function cargarPage(metodo, selector, tabla = "") {
	$.post(baseUrl + metodo, function (data) {
		$("#" + selector).html(data);
		$("#cerrarModal").click();
	})
		.done(() => {
			if (tabla) formatoTabla("tbl" + tabla);
		})
		.fail(ajaxErrors);
}

//----------------CARGA VISTA MODAL DE FORMULARIO---------------
function confirmarVenta(e, metodo) {
	e.preventDefault();
	const formData = new FormData(e.target);

	$.ajax({
		url: metodo,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			$("#btnFormPage").prop("disabled", true);
			$("#cargandoSpinnerPage").removeClass("d-none");
			$("#nomFormPage").addClass("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			if (data.result === 1) {
				//$('#nueva-venta').html(data.vista);
				$("#modal-large").html(data.vista);
				$("#large").modal();
			} else {
				mostrarErrors(data.titulo, data.errores);
			}
		},
		error: ajaxErrors,
		complete: function () {
			$("#btnFormPage").prop("disabled", false);
			$("#cargandoSpinnerPage").addClass("d-none");
			$("#nomFormPage").removeClass("d-none");
		},
	});
}

//---------------CARGA PRODUCTO PARA NUEVA VENTA---------------
function cargarProducto(metodo, selector) {
	$.post(baseUrl + metodo, function (data) {
		if (data != "error") {
			$("#" + selector)
				.html(data)
				.fadeIn(4000);
			mostrarToast("success", "Excelente!", "Producto agregado");
		} else {
			mostrarToast("error", "Error!", "Producto sin Stock");
		}
	}).fail(ajaxErrors);
}

//-----ACTUALIZA LA CANTIDAD DE PRODUCTO PARA NUEVA VENTA-----
function updateCantidad(e, rowid) {
	let cant = parseInt(e.target.value);
	let inputCant = document.getElementById("cant-" + rowid);

	if (!isNaN(cant) && cant > 0) {
		$.post(
			baseUrl + "admin/ventas/nueva/updateCantidad/" + rowid,
			{ cant: cant },
			function (resp) {
				let data = JSON.parse(resp);

				if (data.result == 1) {
					inputCant.classList.remove("bg-danger");
					document.getElementById("subtotal-" + rowid).innerHTML =
						data.subtotal;
					document.getElementById("subtotal-venta").innerHTML = data.total;
					document.getElementById("subtotal-venta2").value =
						data.totalSinFormato;
					document.getElementById("subtotal-venta-pesos").innerHTML =
						data.total_pesos;
					//document.getElementById('total-venta-pesos2').innerHTML = data.total_pesos;
					//console.log(data);
					obtenerBonificacion(document.getElementById("bonificacion"));
				} else {
					inputCant.classList.add("bg-danger");
					mostrarToast("error", data.error, data.msj);
				}
			}
		).fail(ajaxErrors);
	} else {
		inputCant.classList.add("bg-danger");
		mostrarToast("error", "Error!", "Stock insuficiente!");
	}
}

//----ACTUALIZA LA BONIFICACION DEL PRODUCTO PARA NUEVA VENTA----
function updateBonificacion(e, rowid) {
	let bonif = parseFloat(e.target.value);
	let inputBonif = document.getElementById("bonif-" + rowid);

	if (!isNaN(bonif) && bonif >= 0 && bonif < 100) {
		$.post(
			baseUrl + "admin/ventas/nueva/updateBonificacion/" + rowid,
			{ bonif: bonif },
			function (resp) {
				let data = JSON.parse(resp);

				if (data.result == 1) {
					inputBonif.classList.remove("bg-danger");
					document.getElementById("subtotal-" + rowid).innerHTML =
						data.subtotal;
					document.getElementById("subtotal-venta").innerHTML = data.total;
					document.getElementById("subtotal-venta2").value =
						data.totalSinFormato;
					document.getElementById("subtotal-venta-pesos").innerHTML =
						data.total_pesos;
					//document.getElementById('total-venta-pesos2').innerHTML = data.total_pesos;
					//console.log(data);
					obtenerBonificacion(document.getElementById("bonificacion"));
				} else {
					inputBonif.classList.add("bg-danger");
					mostrarToast("error", data.error, data.msj);
				}
			}
		).fail(ajaxErrors);
	} else {
		inputBonif.classList.add("bg-danger");
		mostrarToast(
			"error",
			"Error!",
			"Bonificación debe ser mayor o igual a 0 y menor a 100!"
		);
	}
}

//-----ACTUALIZA EL SUBTOTAL Y TOTAL BONIFICADO DE PRODUCTO PARA NUEVA VENTA-----
function obtenerBonificacion(obj) {
	if (obj.value == "") obj.value = 0;
	document.getElementById("bonificacion").value = obj.value;
	let bonificacion = obj.value;
	let precioDolar = document.getElementById("precio-dolar").value;
	let subtotal = document.getElementById("subtotal-venta2").value;
	let total = document.getElementById("total-venta");
	let totalEnPesos = document.getElementById("total-venta-pesos");

	let resultado =
		parseFloat(subtotal) -
		(parseFloat(subtotal) * parseFloat(bonificacion)) / 100;

	document.getElementById("subtotal-venta-bonif").value = resultado.toFixed(2);
	document.getElementById("total-venta-pesos-bonif").value = (
		resultado * precioDolar
	).toFixed(2);

	total.innerHTML = formatearNumero(resultado);
	totalEnPesos.innerHTML = formatearNumero(resultado * precioDolar);
	//console.log(precioDolar + '  -  ' + subtotal + ' -- ' + formatearNumero(total) );
}

function formatearNumero(numero) {
	let num = new Intl.NumberFormat("es-AR", {
		style: "currency",
		currency: "ARS",
	}).format(numero);
	return num.substring(2);
	//let arreNumero = numero.toFixed(2).toString().split('.');
	//return arreNumero[0] + ',' + arreNumero[1];
}

//-----------------ALTA-UPDATE FORMULARIO MODAL-----------------
function validFormModal(e, metodo, form = "") {
	e.preventDefault();
	const formData = form == "" ? new FormData(e.target) : form;

	$.ajax({
		url: metodo,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,

		beforeSend: function () {
			$("#btnForm").prop("disabled", true);
			$("#cargandoSpinner").removeClass("d-none");
			$("#nomForm").addClass("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			if (data.result === 1) {
				if (typeof data.metodo !== "undefined" && data.metodo !== "no")
					cargarPage(data.metodo, data.selector, data.tabla);

				if (data.tabla == "MediosPago") {
					// Medio de pago
					$("#" + data.selector).html(data.vista);
					if (data.cuentaCorriente == 2)
						$("#btn-medio-pago").prop("disabled", true); // deshabilita boton si se agrego medio de pago cuenta corriente
				}

				if (data.tabla == "Liquidacion") {
					$("#" + data.selector).html(data.vista);
					formatoTabla("tbl" + data.tabla);
				}

				if (typeof data.url_descarga !== "undefined")
					descargarComprobante(data.url_descarga);

				mostrarToast("success", data.titulo, data.msj);

				if (data.tabla == "Lotes") {
					e.target.reset();
				} else {
					$("#cerrarModal").click();
				}
				debugger;
				if (typeof data.url !== "undefined")
					setTimeout(() => (window.location.href = data.url), 1500);
			} else {
				mostrarErrors(data.titulo, data.errores);
			}
		},
		error: ajaxErrors,
		complete: function () {
			$("#btnForm").prop("disabled", false);
			$("#cargandoSpinner").addClass("d-none");
			$("#nomForm").removeClass("d-none");
		},
	});
}

//-----------------ALTA-UPDATE FORMULARIO MODAL-----------------
function validFormModalGasto(e, metodo, form = "") {
	e.preventDefault();
	const formData = form == "" ? new FormData(e.target) : form;

	$.ajax({
		url: metodo,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,

		beforeSend: function () {
			$("#btnForm").prop("disabled", true);
			$("#cargandoSpinner").removeClass("d-none");
			$("#nomForm").addClass("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			if (data.result === 1) {
				mostrarToast("success", data.titulo, data.msj);

				$("#form_filtroGastos").submit();
				$("#cerrarModal").click();
			} else {
				mostrarErrors(data.titulo, data.errores);
			}
		},
		error: ajaxErrors,
		complete: function () {
			$("#btnForm").prop("disabled", false);
			$("#cargandoSpinner").addClass("d-none");
			$("#nomForm").removeClass("d-none");
		},
	});
}

//------------------ALTA-UPDATE FORMULARIO PAGE------------------
function validFormPage(e, metodo) {
	e.preventDefault();
	const formData = new FormData(e.target);

	$.ajax({
		url: metodo,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			$("#btnFormPage").prop("disabled", true);
			$("#cargandoSpinnerPage").removeClass("d-none");
			$("#nomFormPage").addClass("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			if (data.result === 1) {
				//if (data.titulo != 'no')
				mostrarToast("success", data.titulo, data.msj);
				//else
				//window.location.href = data.url;

				// if (typeof data.url_descarga === 'undefined')
				setTimeout(() => (window.location.href = data.url), 1500);
				// else
				// 	descargarFactura(data);
			} else {
				mostrarErrors(data.titulo, data.errores);
			}
		},
		error: ajaxErrors,
		complete: function () {
			$("#btnFormPage").prop("disabled", false);
			$("#cargandoSpinnerPage").addClass("d-none");
			$("#nomFormPage").removeClass("d-none");
		},
	});
}

//-------------------BUSQUEDA FORMULARIO PAGE-------------------
function validFormBusqueda(e, metodo, selector) {
	e.preventDefault();
	const formData = new FormData(e.target);

	$.ajax({
		url: metodo,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			$("#btnFormBusq").prop("disabled", true);
			$("#cargandoSpinnerBusq").removeClass("d-none");
			$("#nomFormBusq").addClass("d-none");
		},
		success: function (data) {
			$("#" + selector)
				.html(data)
				.fadeIn(4000);
		},
		error: ajaxErrors,
		complete: function () {
			$("#btnFormBusq").prop("disabled", false);
			$("#cargandoSpinnerBusq").addClass("d-none");
			$("#nomFormBusq").removeClass("d-none");
		},
	});
}

//--------------OPCION PARA DESCARGAR COMPROBANTE--------------
function descargarComprobante(url_descarga) {
	// Swal.fire({
	// 	title: '¿Desea descargar la factura?',
	// 	text: 'Descarga factura en formato pdf',
	// 	icon: 'question',
	// 	showCancelButton: true,
	// 	confirmButtonColor: '#2c9faf',
	// 	cancelButtonColor: '#d33',
	// 	confirmButtonText: 'Descargar',
	// 	cancelButtonText: 'No'
	// }).then((result) => {
	// 	if (result.value) {
	if (url_descarga != "no") {
		let link = document.createElement("a");
		link.href = url_descarga; //data.url_descarga;
		link.download = "";
		link.dispatchEvent(new MouseEvent("click"));
	}
	// 		mostrarToast('success', 'Excelente!', 'Comprobante descargado');
	// 	}
	// 	setTimeout(() => window.location.href = data.url, 1500);
	// });
}

//----------------------------QUITAR----------------------------
function quitar(e, metodo) {
	cambiarEstado(e, metodo, 44, "Quitar", "El registro se quitará");
}

//----------------------------CANCELAR----------------------------
function cancelar(e, metodo) {
	cambiarEstado(e, metodo, 0, "Cancelar", "El registro se cancelará");
}

//----------------------------ELIMINAR----------------------------
function eliminar(e, metodo) {
	cambiarEstado(e, metodo, 0, "Eliminar", "El registro se eliminará");
}

//----------------CAMBIA EL ESTADO DE UN REGISTRO----------------
function cambiarEstado(e, metodo, est, titulo, msj) {
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
				baseUrl + metodo,
				{ est: est },
				function (data) {
					if (data.result === 1) {
						if (est == 44) $("#tablaLotes").val($("#tablaLotes").val() - 1);

						if (typeof data.total !== "undefined") {
							// patch para nueva venta
							let bonificacion = document.getElementById("bonificacion2");
							$("#subtotal-venta").text(data.total);
							$("#subtotal-venta2").val(data.totalSinFormato);
							$("#subtotal-venta-pesos").text(data.total_pesos);

							if (data.totalSinFormato == 0) {
								bonificacion.readOnly = true;
								bonificacion.value = 0;
							}
							obtenerBonificacion(bonificacion);
						}

						if (typeof data.medioPago !== "undefined")
							$("#btn-medio-pago").prop("disabled", false); // habilita boton para cargar medios de pago

						mostrarToast("success", data.titulo, data.msj);
						$(e).closest("tr").fadeOut(1200);
					} else {
						mostrarErrors(data.titulo, data.errores);
					}
				},
				"json"
			).fail(ajaxErrors);
		}
	});
}

//----------------CANCELAR PAGO - LIQUIDACION----------------
function cancelarPago(e, metodo) {
	Swal.fire({
		title: "¿ Cancelar pago ?",
		text: "El pago realizado se cancelará..",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#2c9faf",
		cancelButtonColor: "#d33",
		confirmButtonText: "Sí!",
		cancelButtonText: "Cancelar",
	}).then((result) => {
		if (result.value) {
			$.post(
				baseUrl + metodo,
				function (data) {
					if (data.result === 1) {
						$("#info-cliente").html(data.vista);

						mostrarToast("success", data.titulo, data.msj);
						$(e).closest("tr").fadeOut(1200);
					} else {
						mostrarErrors(data.titulo, data.errores);
					}
				},
				"json"
			).fail(ajaxErrors);
		}
	});
}

//--------CARGA TABLA PRODUCTO EN BASE A LA SUBCATEGORIA--------
function productosPorSubcategoria() {
	let url = baseUrl + "admin/productos/" + this.dataset.slug;

	history.pushState(null, "", url);

	$.post(url, function (data) {
		$("#productos-main").html(data);
	}).done(() => {
		formatoTabla("tblProductos");
	});
}

//--------CARGA TABLA PRODUCTO EN BASE A LA SUBCATEGORIA--------
function ventasPorEstado() {
	let url = baseUrl + "admin/ventas/" + this.dataset.slug;

	history.pushState(null, "", url);

	$.post(url, function (data) {
		$("#ventas-main").html(data);
	}).done(() => {
		formatoTabla("tblVentas");
	});
}

//------------TRAE INVENTARIO EN BASE A LA CATEGORIA------------
function inventarioPorCategoria() {
	let url = baseUrl + "admin/inventario/" + this.dataset.slug;

	history.pushState(null, "", url);

	$.post(url, function (data) {
		$("#inventario-main").html(data);
	}).done(() => {
		formatoTabla("tblProdStockBajo");
	});
}

//---------------CALCULA PRECIO DE VENTA EN LOTES---------------
function calcularPVenta() {
	const costo = document.getElementById("costo");
	const iva = document.getElementById("iva");
	const margen = document.getElementById("margen");
	const venta = document.getElementById("venta");

	venta.value = (costo.value * iva.value * margen.value).toFixed(2);
}

//---------VERIFICA SI EL CODIGO INGRESADO ES CORRECTO---------
function verificarCodEdicion(e) {
	e.preventDefault();
	const formData = new FormData(e.target);

	$.ajax({
		url: baseUrl + "admin/local/validar",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,

		beforeSend: function () {
			$("#btnForm").prop("disabled", true);
			$("#cargandoSpinner").removeClass("d-none");
			$("#nomForm").addClass("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			if (data.result === 1) {
				cargarForm(data.url, "small", "modal-small");
			} else {
				mostrarErrors(data.titulo, data.errores);
			}
		},
		error: ajaxErrors,
		complete: function () {
			$("#btnForm").prop("disabled", false);
			$("#cargandoSpinner").addClass("d-none");
			$("#nomForm").removeClass("d-none");
		},
	});
}

//----OBTIENE LOS PAGOS REALIZADOS FILTRANDO POR MP y PERIODO----
function obtenerPagos(e) {
	e.preventDefault();
	const formData = new FormData(e.target);
	let btnBuscar = document.getElementById("btnFormPage");

	$.ajax({
		url: baseUrl + "admin/pagos/obtener",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,

		beforeSend: function () {
			btnBuscar.disabled = true;
			btnBuscar.children[0].classList.remove("d-none");
			btnBuscar.children[1].classList.add("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			$("#pagos-main").html(data.vista);
			formatoTabla("tblPagos");

			let mostrarBtn = data.total > 0 ? false : true;
			$("#btnExportarPagos").prop("disabled", mostrarBtn);
		},
		error: ajaxErrors,
		complete: function () {
			btnBuscar.disabled = false;
			btnBuscar.children[0].classList.add("d-none");
			btnBuscar.children[1].classList.remove("d-none");
		},
	});
}

//----OBTIENE LOS PAGOS REALIZADOS FILTRANDO POR MP y PERIODO----
function obtenerGastos(e) {
	e.preventDefault();
	const formData = new FormData(e.target);
	let btnBuscar = document.getElementById("btnFormGasto");

	$.ajax({
		url: baseUrl + "admin/gastos/obtener",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,

		beforeSend: function () {
			btnBuscar.disabled = true;
			btnBuscar.children[0].classList.remove("d-none");
			btnBuscar.children[1].classList.add("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			$("#gastos-main").html(data.vista);
			formatoTabla("tblGastos");

			let mostrarBtn = data.total > 0 ? false : true;
			$("#btnExportarGastos").prop("disabled", mostrarBtn);
		},
		error: ajaxErrors,
		complete: function () {
			btnBuscar.disabled = false;
			btnBuscar.children[0].classList.add("d-none");
			btnBuscar.children[1].classList.remove("d-none");
		},
	});
}

//------------------------EXPORTA A EXCEL------------------------
function exportar(url) {
	location.href = url;
}

//----OBTIENE VENTAS/PAGOS REALIZADOS POR CHEQUE FILTRANDO POR MP y PERIODO----
function obtenerCheques(e) {
	e.preventDefault();
	const formData = new FormData(e.target);
	let btnBuscar = document.getElementById("btnFormPage");

	$.ajax({
		url: baseUrl + "admin/cheques/obtener",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,

		beforeSend: function () {
			btnBuscar.disabled = true;
			btnBuscar.children[0].classList.remove("d-none");
			btnBuscar.children[1].classList.add("d-none");
		},
		success: function (resp) {
			$("#cheques-main").html(resp);
			formatoTabla("tblCheques");
		},
		error: ajaxErrors,
		complete: function () {
			btnBuscar.disabled = false;
			btnBuscar.children[0].classList.add("d-none");
			btnBuscar.children[1].classList.remove("d-none");
		},
	});
}

//---------OCULTAR VENCIMIENTO CUANDO ES CHEQUE COBRADO---------
function hideVencimiento() {
	let estadoCheque = document.getElementById("estado_cheque_id");
	let vencimiento = document.getElementById("modulo-vencimiento");

	if (estadoCheque.options[estadoCheque.selectedIndex].value == 1)
		vencimiento.classList.remove("d-none");
	else vencimiento.classList.add("d-none");
}

// //------------------MARCAR CHEQUE COMO COBRADO------------------
// function chequeCobrado(ele, idPago, nroOperacion) {
// 	Swal.fire({
// 		title: '¿ Marcar como cobrado ?',
// 		text: 'El cheque con numero de operación: ' + nroOperacion + ' se marcará como cobrado..',
// 		icon: 'question',
// 		showCancelButton: true,
// 		confirmButtonColor: '#2c9faf',
// 		cancelButtonColor: '#d33',
// 		confirmButtonText: 'Sí!',
// 		cancelButtonText: 'Cancelar'
// 	}).then((result) => {
// 		if (result.value) {
// 			$.post(baseUrl + 'admin/cheques/cobrarCheque', { idPago: idPago }, function (data) {

// 				if (data.result === 1) {
// 					mostrarToast('success', data.titulo, data.msj);
// 					$(ele).closest('tr').fadeOut(1200);
// 				}
// 				else {
// 					mostrarErrors(data.titulo, data.errores);
// 				}
// 			}, 'json').fail(ajaxErrors);
// 		}
// 	});
// }

//---------------MARCAR VENTA POR CC COMO COBRADA---------------
function ventaPorccCobrado(idPago, idVenta, idCliente) {
	Swal.fire({
		title: "¿ Marcar como cobrado ?",
		text: "La venta N°" + idVenta + " se marcará como cobrada...",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#2c9faf",
		cancelButtonColor: "#d33",
		confirmButtonText: "Sí!",
		cancelButtonText: "Cancelar",
	}).then((result) => {
		if (result.value) {
			$.post(
				baseUrl + "admin/clientes/estado-cuenta/marcarCobradoVentaCC",
				{ idPago: idPago, idVenta: idVenta, idCliente: idCliente },
				function (data) {
					if (data.result === 1) {
						$("#" + data.selector).html(data.vista);
						formatoTabla("tbl" + data.tabla);
						mostrarToast("success", data.titulo, data.msj);
						getCCVencidas();
					} else {
						mostrarErrors(data.titulo, data.errores);
					}
				},
				"json"
			).fail(ajaxErrors);
		}
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
