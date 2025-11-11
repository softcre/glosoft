window.onload = function () {
	formatoTabla("tblExpedientes");
};

//-------------------ELIMINA UN EXPEDIENTE-------------------
function eliminar(ele) {
	const title = "Eliminar";
	const mensaje = "El expediente N° " + ele.dataset.name + " se eliminará...";
	bajaRegistro(ele, ele.dataset.url, title, mensaje);
}
