//------------------VALIDAR FORM LOGIN------------------
function login(e) {
	e.preventDefault();
	const formData = new FormData(e.target);
	const btnLogin = document.getElementById("btnFormLogin");

	$.ajax({
		url: "admin/login",
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			btnLogin.disabled = true;
			btnLogin.children[0].classList.remove("d-none");
			btnLogin.children[1].classList.add("d-none");
		},
		success: function (resp) {
			let data = JSON.parse(resp);

			if (data.status === "ok") {
				mostrarToast("success", data.title, data.msj);

				setTimeout(() => (location.href = data.data.url), 1500);

			} else {
				mostrarErrors(data.title, data.errors);
			}
		},
		error: ajaxErrors,
		complete: function () {
			btnLogin.disabled = false;
			btnLogin.children[0].classList.add("d-none");
			btnLogin.children[1].classList.remove("d-none");
		},
	});
}

//------------------------MUESTRA TOAST------------------------
function mostrarToast(icon, titulo, msj) {
	Swal.fire({
		icon: icon,
		title: titulo,
		text: msj,
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true
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