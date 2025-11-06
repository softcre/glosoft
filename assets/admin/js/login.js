//------------------VALIDAR FORM LOGIN------------------
function login(e) {
	e.preventDefault();
	const formData = new FormData(e.target);
	const btnLogin = document.getElementById("btnFormLogin");

	$.ajax({
		url: e.target.action,
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
